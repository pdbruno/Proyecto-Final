/*!
 * rrule.js - Library for working with recurrence rules for calendar dates.
 * https://github.com/jakubroztocil/rrule
 *
 * Copyright 2010, Jakub Roztocil and Lars Schoning
 * Licenced under the BSD licence.
 * https://github.com/jakubroztocil/rrule/blob/master/LICENCE
 *
 */

/**
 *
 * Implementation of RRule.fromText() and RRule::toText().
 *
 *
 * On the client side, this file needs to be included
 * when those functions are used.
 *
 */
/* global module, define */

;
(function (root, factory) {
  if (typeof module === 'object' && module.exports) {
    module.exports = factory()
  } else if (typeof define === 'function' && define.amd) {
    define([], factory)
  } else {
    root._getRRuleNLP = factory()
  }
}(typeof window === 'object' ? window : this, function () {
  // =============================================================================
  // Helper functions
  // =============================================================================

  /**
   * Return true if a value is in an array
   */
  var contains = function (arr, val) {
    return arr.indexOf(val) !== -1
  }

  return function (RRule) {
    // =============================================================================
    // ToText
    // =============================================================================

    /**
     *
     * @param {RRule} rrule
     * Optional:
     * @param {Function} gettext function
     * @param {Object} language definition
     * @constructor
     */
    var ToText = function (rrule, gettext, language) {
      this.text = ''
      this.language = language || ENGLISH
      this.gettext = gettext || function (id) {
        return id
      }

      this.rrule = rrule
      this.freq = rrule.options.freq
      this.options = rrule.options
      this.origOptions = rrule.origOptions

      if (this.origOptions.bymonthday) {
        var bymonthday = [].concat(this.options.bymonthday)
        var bynmonthday = [].concat(this.options.bynmonthday)

        bymonthday.sort()
        bynmonthday.sort()
        bynmonthday.reverse()
          // 1, 2, 3, .., -5, -4, -3, ..
        this.bymonthday = bymonthday.concat(bynmonthday)
        if (!this.bymonthday.length) this.bymonthday = null
      }

      if (this.origOptions.byweekday) {
        var byweekday = !(this.origOptions.byweekday instanceof Array) ? [
          this.origOptions.byweekday
        ] : this.origOptions.byweekday
        var days = String(byweekday)

        this.byweekday = {
          allWeeks: byweekday.filter(function (weekday) {
            return !Boolean(weekday.n)
          }),
          someWeeks: byweekday.filter(function (weekday) {
            return Boolean(weekday.n)
          }),
          isWeekdays: (
            days.indexOf('MO') !== -1 &&
            days.indexOf('TU') !== -1 &&
            days.indexOf('WE') !== -1 &&
            days.indexOf('TH') !== -1 &&
            days.indexOf('FR') !== -1 &&
            days.indexOf('SA') === -1 &&
            days.indexOf('SU') === -1
          )
        }

        var sortWeekDays = function (a, b) {
          return a.weekday - b.weekday
        }

        this.byweekday.allWeeks.sort(sortWeekDays)
        this.byweekday.someWeeks.sort(sortWeekDays)

        if (!this.byweekday.allWeeks.length) this.byweekday.allWeeks =
          null
        if (!this.byweekday.someWeeks.length) this.byweekday.someWeeks =
          null
      } else {
        this.byweekday = null
      }
    }

    var common = [
      'count', 'until', 'interval',
      'byweekday', 'bymonthday', 'bymonth'
    ]
    ToText.IMPLEMENTED = []
    ToText.IMPLEMENTED[RRule.HOURLY] = common
    ToText.IMPLEMENTED[RRule.DAILY] = ['byhour'].concat(common)
    ToText.IMPLEMENTED[RRule.WEEKLY] = common
    ToText.IMPLEMENTED[RRule.MONTHLY] = common
    ToText.IMPLEMENTED[RRule.YEARLY] = ['byweekno', 'byyearday'].concat(
      common)

    /**
     * Test whether the rrule can be fully converted to text.
     * @param {RRule} rrule
     * @return {Boolean}
     */
    ToText.isFullyConvertible = function (rrule) {
      var canConvert = true

      if (!(rrule.options.freq in ToText.IMPLEMENTED)) return false
      if (rrule.origOptions.until && rrule.origOptions.count) return
      false

      for (var key in rrule.origOptions) {
        if (contains(['dtstart', 'wkst', 'freq'], key)) return true
        if (!contains(ToText.IMPLEMENTED[rrule.options.freq], key))
          return false
      }

      return canConvert
    }

    ToText.prototype = {
      constructor: ToText,

      isFullyConvertible: function () {
        return ToText.isFullyConvertible(this.rrule)
      },

      /**
       * Perform the conversion. Only some of the frequencies are supported.
       * If some of the rrule's options aren't supported, they'll
       * be omitted from the output an "(~ approximate)" will be appended.
       * @return {*}
       */
      toString: function () {
        var gettext = this.gettext

        if (!(this.options.freq in ToText.IMPLEMENTED)) {
          return gettext(
            'RRule error: Unable to fully convert this rrule to text'
          )
        }

        this.text = [gettext('todos los/as')]
        this[RRule.FREQUENCIES[this.options.freq]]()

        if (this.options.until) {
          this.add(gettext('hasta'))
          var until = this.options.until
          this.add(this.language.monthNames[until.getMonth()])
            .add(until.getDate() + ',')
            .add(until.getFullYear())
        } else if (this.options.count) {
          this.add(gettext('por'))
            .add(this.options.count)
            .add(this.plural(this.options.count) ? gettext('veces') :
              gettext('veces'))
        }

        if (!this.isFullyConvertible()) this.add(gettext(
          '(~ aproximadamente)'))

        return this.text.join('')
      },

      HOURLY: function () {
        var gettext = this.gettext

        if (this.options.interval !== 1) this.add(this.options.interval)

        this.add(this.plural(this.options.interval) ? gettext('hours') :
          gettext('hour'))
      },

      DAILY: function () {
        var gettext = this.gettext

        if (this.options.interval !== 1) this.add(this.options.interval)

        if (this.byweekday && this.byweekday.isWeekdays) {
          this.add(this.plural(this.options.interval) ? gettext(
            'días de semana') : gettext('días de semana'))
        } else {
          this.add(this.plural(this.options.interval) ? gettext(
            'días') : gettext('día'))
        }

        if (this.origOptions.bymonth) {
          this.add(gettext('en'))
          this._bymonth()
        }

        if (this.bymonthday) {
          this._bymonthday()
        } else if (this.byweekday) {
          this._byweekday()
        } else if (this.origOptions.byhour) {
          this._byhour()
        }
      },

      WEEKLY: function () {
        var gettext = this.gettext

        if (this.options.interval !== 1) {
          this.add(this.options.interval)
            .add(this.plural(this.options.interval) ? gettext('semanas') :
              gettext('semana'))
        }

        if (this.byweekday && this.byweekday.isWeekdays) {
          if (this.options.interval === 1) {
            this.add(this.plural(this.options.interval) ? gettext(
              'días de semana') : gettext('días de semana'))
          } else {
            this.add(gettext('los')).add(gettext('días de semana'))
          }
        } else {
          if (this.options.interval === 1) this.add(gettext('semanas'))

          if (this.origOptions.bymonth) {
            this.add(gettext('en'))
            this._bymonth()
          }

          if (this.bymonthday) {
            this._bymonthday()
          } else if (this.byweekday) {
            this._byweekday()
          }
        }
      },

      MONTHLY: function () {
        var gettext = this.gettext

        if (this.origOptions.bymonth) {
          if (this.options.interval !== 1) {
            this.add(this.options.interval).add(gettext('meses'))
            if (this.plural(this.options.interval)) this.add(gettext(
              'en'))
          } else {
            // this.add(gettext('MONTH'))
          }
          this._bymonth()
        } else {
          if (this.options.interval !== 1) this.add(this.options.interval)
          this.add(this.plural(this.options.interval) ? gettext(
            'meses') : gettext('mes'))
        }
        if (this.bymonthday) {
          this._bymonthday()
        } else if (this.byweekday && this.byweekday.isWeekdays) {
          this.add(gettext('los')).add(gettext('días de semana'))
        } else if (this.byweekday) {
          this._byweekday()
        }
      },

      YEARLY: function () {
        var gettext = this.gettext

        if (this.origOptions.bymonth) {
          if (this.options.interval !== 1) {
            this.add(this.options.interval)
            this.add(gettext('años'))
          } else {
            // this.add(gettext('YEAR'))
          }
          this._bymonth()
        } else {
          if (this.options.interval !== 1) this.add(this.options.interval)
          this.add(this.plural(this.options.interval) ? gettext(
            'años') : gettext('año'))
        }

        if (this.bymonthday) {
          this._bymonthday()
        } else if (this.byweekday) {
          this._byweekday()
        }

        if (this.options.byyearday) {
          this.add(gettext('el'))
            .add(this.list(this.options.byyearday, this.nth, gettext(
              'y')))
            .add(gettext('día'))
        }

        if (this.options.byweekno) {
          this.add(gettext('en'))
            .add(this.plural(this.options.byweekno.length) ? gettext(
              'semanas') : gettext('semana'))
            .add(this.list(this.options.byweekno, null, gettext('y')))
        }
      },

      _bymonthday: function () {
        var gettext = this.gettext
        if (this.byweekday && this.byweekday.allWeeks) {
          this.add(gettext('en'))
            .add(this.list(this.byweekday.allWeeks, this.weekdaytext,
              gettext('o')))
            .add(gettext('el'))
            .add(this.list(this.bymonthday, this.nth, gettext('o')))
        } else {
          this.add(gettext('el'))
            .add(this.list(this.bymonthday, this.nth, gettext('y')))
        }
        // this.add(gettext('DAY'))
      },

      _byweekday: function () {
        var gettext = this.gettext
        if (this.byweekday.allWeeks && !this.byweekday.isWeekdays) {
          this.add(gettext('los'))
            .add(this.list(this.byweekday.allWeeks, this.weekdaytext))
        }

        if (this.byweekday.someWeeks) {
          if (this.byweekday.allWeeks) this.add(gettext('y'))

          this.add(gettext('el'))
            .add(this.list(this.byweekday.someWeeks, this.weekdaytext,
              gettext('y')))
        }
      },

      _byhour: function () {
        var gettext = this.gettext

        this.add(gettext('a las'))
          .add(this.list(this.origOptions.byhour, null, gettext('y')))
      },

      _bymonth: function () {
        this.add(this.list(this.options.bymonth, this.monthtext, this
          .gettext('y')))
      },

      nth: function (n) {
        var nth, npos
        var gettext = this.gettext

        if (n === -1) return gettext('last')

        npos = Math.abs(n)
        switch (npos) {
        case 1:
        case 21:
        case 31:
		case 3:
		case 13:
        case 23:
          nth = npos + gettext('er')
          break
        case 2:
        case 22:
          nth = npos + gettext('do')
          break
        
		case 7:
		case 17:
		case 27:
		case 10:
		case 20:
		case 30:
          nth = npos + gettext('mo')
          break
		case 8:
		case 18:
		case 28:
          nth = npos + gettext('vo')
		case 9:
		case 19:
		case 29:
          nth = npos + gettext('no')
          break
        default:
          nth = npos + gettext('to')
        }

        return n < 0 ? nth + ' ' + gettext('último/a') : nth
      },

      monthtext: function (m) {
        return this.language.monthNames[m - 1]
      },

      weekdaytext: function (wday) {
        var weekday = typeof wday === 'number' ? wday : wday.getJsWeekday()
        return (wday.n ? this.nth(wday.n) + ' ' : '') +
          this.language.dayNames[weekday]
      },

      plural: function (n) {
        return n % 100 !== 1
      },

      add: function (s) {
        this.text.push(' ')
        this.text.push(s)
        return this
      },

      list: function (arr, callback, finalDelim, delim) {
        var delimJoin = function (array, delimiter, finalDelimiter) {
          var list = ''

          for (var i = 0; i < array.length; i++) {
            if (i !== 0) {
              if (i === array.length - 1) {
                list += ' ' + finalDelimiter + ' '
              } else {
                list += delimiter + ' '
              }
            }
            list += array[i]
          }
          return list
        }

        delim = delim || ','
        callback = callback || function (o) {
          return o
        }
        var self = this
        var realCallback = function (arg) {
          return callback.call(self, arg)
        }

        if (finalDelim) {
          return delimJoin(arr.map(realCallback), delim, finalDelim)
        } else {
          return arr.map(realCallback).join(delim + ' ')
        }
      }
    }

    // =============================================================================
    // fromText
    // =============================================================================
    /**
     * Will be able to convert some of the below described rules from
     * text format to a rule object.
     *
     *
     * RULES
     *
     * Every ([n])
     *       day(s)
     *     | [weekday], ..., (and) [weekday]
     *     | weekday(s)
     *     | week(s)
     *     | month(s)
     *     | [month], ..., (and) [month]
     *     | year(s)
     *
     *
     * Plus 0, 1, or multiple of these:
     *
     * on [weekday], ..., (or) [weekday] the [monthday], [monthday], ... (or) [monthday]
     *
     * on [weekday], ..., (and) [weekday]
     *
     * on the [monthday], [monthday], ... (and) [monthday] (day of the month)
     *
     * on the [nth-weekday], ..., (and) [nth-weekday] (of the month/year)
     *
     *
     * Plus 0 or 1 of these:
     *
     * for [n] time(s)
     *
     * until [date]
     *
     * Plus (.)
     *
     *
     * Definitely no supported for parsing:
     *
     * (for year):
     *     in week(s) [n], ..., (and) [n]
     *
     *     on the [yearday], ..., (and) [n] day of the year
     *     on day [yearday], ..., (and) [n]
     *
     *
     * NON-TERMINALS
     *
     * [n]: 1, 2 ..., one, two, three ..
     * [month]: January, February, March, April, May, ... December
     * [weekday]: Monday, ... Sunday
     * [nth-weekday]: first [weekday], 2nd [weekday], ... last [weekday], ...
     * [monthday]: first, 1., 2., 1st, 2nd, second, ... 31st, last day, 2nd last day, ..
     * [date]:
     *     [month] (0-31(,) ([year])),
     *     (the) 0-31.(1-12.([year])),
     *     (the) 0-31/(1-12/([year])),
     *     [weekday]
     *
     * [year]: 0000, 0001, ... 01, 02, ..
     *
     * Definitely not supported for parsing:
     *
     * [yearday]: first, 1., 2., 1st, 2nd, second, ... 366th, last day, 2nd last day, ..
     *
     * @param {String} text
     * @return {Object, Boolean} the rule, or null.
     */
    var fromText = function (text, language) {
      return new RRule(parseText(text, language))
    }

    var parseText = function (text, language) {
      var options = {}
      var ttr = new Parser((language || ENGLISH).tokens)

      if (!ttr.start(text)) return null

      S()
      return options

      function S() {
        // every [n]
        var n

        ttr.expect('every')
        if ((n = ttr.accept('number'))) options.interval = parseInt(n[0],
          10)
        if (ttr.isDone()) throw new Error('Unexpected end')

        switch (ttr.symbol) {
        case 'day(s)':
          options.freq = RRule.DAILY
          if (ttr.nextSymbol()) {
            AT()
            F()
          }
          break

          // FIXME Note: every 2 weekdays != every two weeks on weekdays.
          // DAILY on weekdays is not a valid rule
        case 'weekday(s)':
          options.freq = RRule.WEEKLY
          options.byweekday = [
            RRule.MO,
            RRule.TU,
            RRule.WE,
            RRule.TH,
            RRule.FR
          ]
          ttr.nextSymbol()
          F()
          break

        case 'week(s)':
          options.freq = RRule.WEEKLY
          if (ttr.nextSymbol()) {
            ON()
            F()
          }
          break

        case 'hour(s)':
          options.freq = RRule.HOURLY
          if (ttr.nextSymbol()) {
            ON()
            F()
          }
          break

        case 'month(s)':
          options.freq = RRule.MONTHLY
          if (ttr.nextSymbol()) {
            ON()
            F()
          }
          break

        case 'year(s)':
          options.freq = RRule.YEARLY
          if (ttr.nextSymbol()) {
            ON()
            F()
          }
          break

        case 'monday':
        case 'tuesday':
        case 'wednesday':
        case 'thursday':
        case 'friday':
        case 'saturday':
        case 'sunday':
          options.freq = RRule.WEEKLY
          options.byweekday = [RRule[ttr.symbol.substr(0, 2).toUpperCase()]]

          if (!ttr.nextSymbol()) return

          // TODO check for duplicates
          while (ttr.accept('comma')) {
            if (ttr.isDone()) throw new Error('Unexpected end')

            var wkd
            if (!(wkd = decodeWKD())) {
              throw new Error('Unexpected symbol ' + ttr.symbol +
                ', expected weekday')
            }

            options.byweekday.push(RRule[wkd])
            ttr.nextSymbol()
          }
          MDAYs()
          F()
          break

        case 'january':
        case 'february':
        case 'march':
        case 'april':
        case 'may':
        case 'june':
        case 'july':
        case 'august':
        case 'september':
        case 'october':
        case 'november':
        case 'december':
          options.freq = RRule.YEARLY
          options.bymonth = [decodeM()]

          if (!ttr.nextSymbol()) return

          // TODO check for duplicates
          while (ttr.accept('comma')) {
            if (ttr.isDone()) throw new Error('Unexpected end')

            var m
            if (!(m = decodeM())) {
              throw new Error('Unexpected symbol ' + ttr.symbol +
                ', expected month')
            }

            options.bymonth.push(m)
            ttr.nextSymbol()
          }

          ON()
          F()
          break

        default:
          throw new Error('Unknown symbol')

        }
      }

      function ON() {
        var on = ttr.accept('on')
        var the = ttr.accept('the')
        if (!(on || the)) return

        do {
          var nth, wkd, m

          // nth <weekday> | <weekday>
          if ((nth = decodeNTH())) {
            // ttr.nextSymbol()

            if ((wkd = decodeWKD())) {
              ttr.nextSymbol()
              if (!options.byweekday) options.byweekday = []
              options.byweekday.push(RRule[wkd].nth(nth))
            } else {
              if (!options.bymonthday) options.bymonthday = []
              options.bymonthday.push(nth)
              ttr.accept('day(s)')
            }
            // <weekday>
          } else if ((wkd = decodeWKD())) {
            ttr.nextSymbol()
            if (!options.byweekday) options.byweekday = []
            options.byweekday.push(RRule[wkd])
          } else if (ttr.symbol === 'weekday(s)') {
            ttr.nextSymbol()
            if (!options.byweekday) options.byweekday = []
            options.byweekday.push(RRule.MO)
            options.byweekday.push(RRule.TU)
            options.byweekday.push(RRule.WE)
            options.byweekday.push(RRule.TH)
            options.byweekday.push(RRule.FR)
          } else if (ttr.symbol === 'week(s)') {
            ttr.nextSymbol()
            var n
            if (!(n = ttr.accept('number'))) {
              throw new Error('Unexpected symbol ' + ttr.symbol +
                ', expected week number')
            }
            options.byweekno = [n[0]]
            while (ttr.accept('comma')) {
              if (!(n = ttr.accept('number'))) {
                throw new Error('Unexpected symbol ' + ttr.symbol +
                  '; expected monthday')
              }
              options.byweekno.push(n[0])
            }
          } else if ((m = decodeM())) {
            ttr.nextSymbol()
            if (!options.bymonth) options.bymonth = []
            options.bymonth.push(m)
          } else {
            return
          }
        } while (ttr.accept('comma') || ttr.accept('the') || ttr.accept(
            'on'))
      }

      function AT() {
        var at = ttr.accept('at')
        if (!at) return

        do {
          var n
          if (!(n = ttr.accept('number'))) {
            throw new Error('Unexpected symbol ' + ttr.symbol +
              ', expected hour')
          }
          options.byhour = [n[0]]
          while (ttr.accept('comma')) {
            if (!(n = ttr.accept('number'))) {
              throw new Error('Unexpected symbol ' + ttr.symbol +
                '; expected hour')
            }
            options.byhour.push(n[0])
          }
        } while (ttr.accept('comma') || ttr.accept('at'))
      }

      function decodeM() {
        switch (ttr.symbol) {
        case 'january':
          return 1
        case 'february':
          return 2
        case 'march':
          return 3
        case 'april':
          return 4
        case 'may':
          return 5
        case 'june':
          return 6
        case 'july':
          return 7
        case 'august':
          return 8
        case 'september':
          return 9
        case 'october':
          return 10
        case 'november':
          return 11
        case 'december':
          return 12
        default:
          return false
        }
      }

      function decodeWKD() {
        switch (ttr.symbol) {
        case 'monday':
        case 'tuesday':
        case 'wednesday':
        case 'thursday':
        case 'friday':
        case 'saturday':
        case 'sunday':
          return ttr.symbol.substr(0, 2).toUpperCase()
        default:
          return false
        }
      }

      function decodeNTH() {
        switch (ttr.symbol) {
        case 'last':
          ttr.nextSymbol()
          return -1
        case 'first':
          ttr.nextSymbol()
          return 1
        case 'second':
          ttr.nextSymbol()
          return ttr.accept('last') ? -2 : 2
        case 'third':
          ttr.nextSymbol()
          return ttr.accept('last') ? -3 : 3
        case 'nth':
          var v = parseInt(ttr.value[1], 10)
          if (v < -366 || v > 366) throw new Error('Nth out of range: ' +
            v)

          ttr.nextSymbol()
          return ttr.accept('last') ? -v : v

        default:
          return false
        }
      }

      function MDAYs() {
        ttr.accept('on')
        ttr.accept('the')

        var nth
        if (!(nth = decodeNTH())) return

        options.bymonthday = [nth]
        ttr.nextSymbol()

        while (ttr.accept('comma')) {
          if (!(nth = decodeNTH())) {
            throw new Error('Unexpected symbol ' + ttr.symbol +
              '; expected monthday')
          }

          options.bymonthday.push(nth)
          ttr.nextSymbol()
        }
      }

      function F() {
        if (ttr.symbol === 'until') {
          var date = Date.parse(ttr.text)

          if (!date) throw new Error('Cannot parse until date:' + ttr.text)
          options.until = new Date(date)
        } else if (ttr.accept('for')) {
          options.count = ttr.value[0]
          ttr.expect('number')
            // ttr.expect('times')
        }
      }
    }

    // =============================================================================
    // Parser
    // =============================================================================

    var Parser = function (rules) {
      this.rules = rules
    }

    Parser.prototype.start = function (text) {
      this.text = text
      this.done = false
      return this.nextSymbol()
    }

    Parser.prototype.isDone = function () {
      return this.done && this.symbol == null
    }

    Parser.prototype.nextSymbol = function () {
      var best, bestSymbol
      var p = this

      this.symbol = null
      this.value = null
      do {
        if (this.done) return false

        var match, rule
        best = null
        for (var name in this.rules) {
          rule = this.rules[name]
          if ((match = rule.exec(p.text))) {
            if (best == null || match[0].length > best[0].length) {
              best = match
              bestSymbol = name
            }
          }
        }

        if (best != null) {
          this.text = this.text.substr(best[0].length)

          if (this.text === '') this.done = true
        }

        if (best == null) {
          this.done = true
          this.symbol = null
          this.value = null
          return
        }
      } while (bestSymbol === 'SKIP')

      this.symbol = bestSymbol
      this.value = best
      return true
    }

    Parser.prototype.accept = function (name) {
      if (this.symbol === name) {
        if (this.value) {
          var v = this.value
          this.nextSymbol()
          return v
        }

        this.nextSymbol()
        return true
      }

      return false
    }

    Parser.prototype.expect = function (name) {
      if (this.accept(name)) return true

      throw new Error('expected ' + name + ' but found ' + this.symbol)
    }

    // =============================================================================
    // i18n
    // =============================================================================

    var ENGLISH = {
      dayNames: [
        'Domingos', 'Lunes', 'Martes', 'Miércoles',
        'Jueves', 'Viernes', 'Sábados'
      ],
      monthNames: [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
        'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
        'Noviembre', 'Diciembre'
      ],
      tokens: {
        'SKIP': /^[ \r\n\t]+|^\.$/,
        'number': /^[1-9][0-9]*/,
        'numberAsText': /^(one|two|three)/i,
        'todos los/as': /^every/i,
        'día(s)': /^days?/i,
        'día(s) de semana': /^weekdays?/i,
        'semana(s)': /^weeks?/i,
        'hora(s)': /^hours?/i,
        'mes(es)': /^months?/i,
        'año(s)': /^years?/i,
        'los/as': /^(on|in)/i,
        'a las': /^(at)/i,
        'el': /^the/i,
        'primer': /^first/i,
        'segundo': /^second/i,
        'tercer': /^third/i,
        '°': /^([1-9][0-9]*)(\.|th|nd|rd|st)/i,
        'último/a': /^last/i,
        'por': /^for/i,
        'vez(ces)': /^times?/i,
        'hasta': /^(un)?til/i,
        'Lunes': /^mo(n(day)?)?/i,
        'Martes': /^tu(e(s(day)?)?)?/i,
        'Miércoles': /^we(d(n(esday)?)?)?/i,
        'Jueves': /^th(u(r(sday)?)?)?/i,
        'Viernes': /^fr(i(day)?)?/i,
        'Sábados': /^sa(t(urday)?)?/i,
        'Domingos': /^su(n(day)?)?/i,
        'Enero': /^jan(uary)?/i,
        'Febrero': /^feb(ruary)?/i,
        'Marzo': /^mar(ch)?/i,
        'Abril': /^apr(il)?/i,
        'Mayo': /^may/i,
        'Junio': /^june?/i,
        'Julio': /^july?/i,
        'Agosto': /^aug(ust)?/i,
        'Septiembre': /^sep(t(ember)?)?/i,
        'Noviembre': /^oct(ober)?/i,
        'Noviembre': /^nov(ember)?/i,
        'Diciembre': /^dec(ember)?/i,
        'comma': /^(,\s*|(and|or)\s*)+/i
      }
    }

    // =============================================================================
    // Export
    // =============================================================================

    return {
      fromText: fromText,
      parseText: parseText,
      isFullyConvertible: ToText.isFullyConvertible,
      toText: function (rrule, gettext, language) {
        return new ToText(rrule, gettext, language).toString()
      }
    }
  }
}))

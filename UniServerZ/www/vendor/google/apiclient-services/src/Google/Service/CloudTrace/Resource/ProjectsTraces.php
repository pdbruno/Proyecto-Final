<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

/**
 * The "traces" collection of methods.
 * Typical usage is:
 *  <code>
 *   $cloudtraceService = new Google_Service_CloudTrace(...);
 *   $traces = $cloudtraceService->traces;
 *  </code>
 */
class Google_Service_CloudTrace_Resource_ProjectsTraces extends Google_Service_Resource
{
  /**
   * Gets a single trace by its ID. (traces.get)
   *
   * @param string $projectId ID of the Cloud project where the trace data is
   * stored.
   * @param string $traceId ID of the trace to return.
   * @param array $optParams Optional parameters.
   * @return Google_Service_CloudTrace_Trace
   */
  public function get($projectId, $traceId, $optParams = array())
  {
    $params = array('projectId' => $projectId, 'traceId' => $traceId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_CloudTrace_Trace");
  }
  /**
   * Returns of a list of traces that match the specified filter conditions.
   * (traces.listProjectsTraces)
   *
   * @param string $projectId ID of the Cloud project where the trace data is
   * stored.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string filter An optional filter against labels for the request.
   *
   * By default, searches use prefix matching. To specify exact match, prepend a
   * plus symbol (`+`) to the search term. Multiple terms are ANDed. Syntax:
   *
   * *   `root:NAME_PREFIX` or `NAME_PREFIX`: Return traces where any root
   * span starts with `NAME_PREFIX`. *   `+root:NAME` or `+NAME`: Return traces
   * where any root span's name is     exactly `NAME`. *   `span:NAME_PREFIX`:
   * Return traces where any span starts with     `NAME_PREFIX`. *   `+span:NAME`:
   * Return traces where any span's name is exactly     `NAME`. *
   * `latency:DURATION`: Return traces whose overall latency is     greater or
   * equal to than `DURATION`. Accepted units are nanoseconds     (`ns`),
   * milliseconds (`ms`), and seconds (`s`). Default is `ms`. For     example,
   * `latency:24ms` returns traces whose overall latency     is greater than or
   * equal to 24 milliseconds. *   `label:LABEL_KEY`: Return all traces containing
   * the specified     label key (exact match, case-sensitive) regardless of the
   * key:value     pair's value (including empty values). *
   * `LABEL_KEY:VALUE_PREFIX`: Return all traces containing the specified
   * label key (exact match, case-sensitive) whose value starts with
   * `VALUE_PREFIX`. Both a key and a value must be specified. *
   * `+LABEL_KEY:VALUE`: Return all traces containing a key:value pair     exactly
   * matching the specified text. Both a key and a value must be     specified. *
   * `method:VALUE`: Equivalent to `/http/method:VALUE`. *   `url:VALUE`:
   * Equivalent to `/http/url:VALUE`.
   * @opt_param string endTime End of the time interval (inclusive) during which
   * the trace data was collected from the application.
   * @opt_param string startTime Start of the time interval (inclusive) during
   * which the trace data was collected from the application.
   * @opt_param string pageToken Token identifying the page of results to return.
   * If provided, use the value of the `next_page_token` field from a previous
   * request. Optional.
   * @opt_param int pageSize Maximum number of traces to return. If not specified
   * or <= 0, the implementation selects a reasonable value.  The implementation
   * may return fewer traces than the requested page size. Optional.
   * @opt_param string view Type of data returned for traces in the list.
   * Optional. Default is `MINIMAL`.
   * @opt_param string orderBy Field used to sort the returned traces. Optional.
   * Can be one of the following:
   *
   * *   `trace_id` *   `name` (`name` field of root span in the trace) *
   * `duration` (difference between `end_time` and `start_time` fields of      the
   * root span) *   `start` (`start_time` field of the root span)
   *
   * Descending order can be specified by appending `desc` to the sort field (for
   * example, `name desc`).
   *
   * Only one sort field is permitted.
   * @return Google_Service_CloudTrace_ListTracesResponse
   */
  public function listProjectsTraces($projectId, $optParams = array())
  {
    $params = array('projectId' => $projectId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_CloudTrace_ListTracesResponse");
  }
}

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

class Google_Service_TagManager_Trigger extends Google_Collection
{
  protected $collection_key = 'filter';
  public $accountId;
  protected $autoEventFilterType = 'Google_Service_TagManager_Condition';
  protected $autoEventFilterDataType = 'array';
  protected $checkValidationType = 'Google_Service_TagManager_Parameter';
  protected $checkValidationDataType = '';
  public $containerId;
  protected $continuousTimeMinMillisecondsType = 'Google_Service_TagManager_Parameter';
  protected $continuousTimeMinMillisecondsDataType = '';
  protected $customEventFilterType = 'Google_Service_TagManager_Condition';
  protected $customEventFilterDataType = 'array';
  protected $eventNameType = 'Google_Service_TagManager_Parameter';
  protected $eventNameDataType = '';
  protected $filterType = 'Google_Service_TagManager_Condition';
  protected $filterDataType = 'array';
  public $fingerprint;
  protected $horizontalScrollPercentageListType = 'Google_Service_TagManager_Parameter';
  protected $horizontalScrollPercentageListDataType = '';
  protected $intervalType = 'Google_Service_TagManager_Parameter';
  protected $intervalDataType = '';
  protected $intervalSecondsType = 'Google_Service_TagManager_Parameter';
  protected $intervalSecondsDataType = '';
  protected $limitType = 'Google_Service_TagManager_Parameter';
  protected $limitDataType = '';
  protected $maxTimerLengthSecondsType = 'Google_Service_TagManager_Parameter';
  protected $maxTimerLengthSecondsDataType = '';
  public $name;
  public $notes;
  public $parentFolderId;
  public $path;
  protected $selectorType = 'Google_Service_TagManager_Parameter';
  protected $selectorDataType = '';
  public $tagManagerUrl;
  protected $totalTimeMinMillisecondsType = 'Google_Service_TagManager_Parameter';
  protected $totalTimeMinMillisecondsDataType = '';
  public $triggerId;
  public $type;
  protected $uniqueTriggerIdType = 'Google_Service_TagManager_Parameter';
  protected $uniqueTriggerIdDataType = '';
  protected $verticalScrollPercentageListType = 'Google_Service_TagManager_Parameter';
  protected $verticalScrollPercentageListDataType = '';
  protected $visibilitySelectorType = 'Google_Service_TagManager_Parameter';
  protected $visibilitySelectorDataType = '';
  protected $visiblePercentageMaxType = 'Google_Service_TagManager_Parameter';
  protected $visiblePercentageMaxDataType = '';
  protected $visiblePercentageMinType = 'Google_Service_TagManager_Parameter';
  protected $visiblePercentageMinDataType = '';
  protected $waitForTagsType = 'Google_Service_TagManager_Parameter';
  protected $waitForTagsDataType = '';
  protected $waitForTagsTimeoutType = 'Google_Service_TagManager_Parameter';
  protected $waitForTagsTimeoutDataType = '';
  public $workspaceId;

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  public function setAutoEventFilter($autoEventFilter)
  {
    $this->autoEventFilter = $autoEventFilter;
  }
  public function getAutoEventFilter()
  {
    return $this->autoEventFilter;
  }
  public function setCheckValidation(Google_Service_TagManager_Parameter $checkValidation)
  {
    $this->checkValidation = $checkValidation;
  }
  public function getCheckValidation()
  {
    return $this->checkValidation;
  }
  public function setContainerId($containerId)
  {
    $this->containerId = $containerId;
  }
  public function getContainerId()
  {
    return $this->containerId;
  }
  public function setContinuousTimeMinMilliseconds(Google_Service_TagManager_Parameter $continuousTimeMinMilliseconds)
  {
    $this->continuousTimeMinMilliseconds = $continuousTimeMinMilliseconds;
  }
  public function getContinuousTimeMinMilliseconds()
  {
    return $this->continuousTimeMinMilliseconds;
  }
  public function setCustomEventFilter($customEventFilter)
  {
    $this->customEventFilter = $customEventFilter;
  }
  public function getCustomEventFilter()
  {
    return $this->customEventFilter;
  }
  public function setEventName(Google_Service_TagManager_Parameter $eventName)
  {
    $this->eventName = $eventName;
  }
  public function getEventName()
  {
    return $this->eventName;
  }
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }
  public function getFilter()
  {
    return $this->filter;
  }
  public function setFingerprint($fingerprint)
  {
    $this->fingerprint = $fingerprint;
  }
  public function getFingerprint()
  {
    return $this->fingerprint;
  }
  public function setHorizontalScrollPercentageList(Google_Service_TagManager_Parameter $horizontalScrollPercentageList)
  {
    $this->horizontalScrollPercentageList = $horizontalScrollPercentageList;
  }
  public function getHorizontalScrollPercentageList()
  {
    return $this->horizontalScrollPercentageList;
  }
  public function setInterval(Google_Service_TagManager_Parameter $interval)
  {
    $this->interval = $interval;
  }
  public function getInterval()
  {
    return $this->interval;
  }
  public function setIntervalSeconds(Google_Service_TagManager_Parameter $intervalSeconds)
  {
    $this->intervalSeconds = $intervalSeconds;
  }
  public function getIntervalSeconds()
  {
    return $this->intervalSeconds;
  }
  public function setLimit(Google_Service_TagManager_Parameter $limit)
  {
    $this->limit = $limit;
  }
  public function getLimit()
  {
    return $this->limit;
  }
  public function setMaxTimerLengthSeconds(Google_Service_TagManager_Parameter $maxTimerLengthSeconds)
  {
    $this->maxTimerLengthSeconds = $maxTimerLengthSeconds;
  }
  public function getMaxTimerLengthSeconds()
  {
    return $this->maxTimerLengthSeconds;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setNotes($notes)
  {
    $this->notes = $notes;
  }
  public function getNotes()
  {
    return $this->notes;
  }
  public function setParentFolderId($parentFolderId)
  {
    $this->parentFolderId = $parentFolderId;
  }
  public function getParentFolderId()
  {
    return $this->parentFolderId;
  }
  public function setPath($path)
  {
    $this->path = $path;
  }
  public function getPath()
  {
    return $this->path;
  }
  public function setSelector(Google_Service_TagManager_Parameter $selector)
  {
    $this->selector = $selector;
  }
  public function getSelector()
  {
    return $this->selector;
  }
  public function setTagManagerUrl($tagManagerUrl)
  {
    $this->tagManagerUrl = $tagManagerUrl;
  }
  public function getTagManagerUrl()
  {
    return $this->tagManagerUrl;
  }
  public function setTotalTimeMinMilliseconds(Google_Service_TagManager_Parameter $totalTimeMinMilliseconds)
  {
    $this->totalTimeMinMilliseconds = $totalTimeMinMilliseconds;
  }
  public function getTotalTimeMinMilliseconds()
  {
    return $this->totalTimeMinMilliseconds;
  }
  public function setTriggerId($triggerId)
  {
    $this->triggerId = $triggerId;
  }
  public function getTriggerId()
  {
    return $this->triggerId;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
  public function setUniqueTriggerId(Google_Service_TagManager_Parameter $uniqueTriggerId)
  {
    $this->uniqueTriggerId = $uniqueTriggerId;
  }
  public function getUniqueTriggerId()
  {
    return $this->uniqueTriggerId;
  }
  public function setVerticalScrollPercentageList(Google_Service_TagManager_Parameter $verticalScrollPercentageList)
  {
    $this->verticalScrollPercentageList = $verticalScrollPercentageList;
  }
  public function getVerticalScrollPercentageList()
  {
    return $this->verticalScrollPercentageList;
  }
  public function setVisibilitySelector(Google_Service_TagManager_Parameter $visibilitySelector)
  {
    $this->visibilitySelector = $visibilitySelector;
  }
  public function getVisibilitySelector()
  {
    return $this->visibilitySelector;
  }
  public function setVisiblePercentageMax(Google_Service_TagManager_Parameter $visiblePercentageMax)
  {
    $this->visiblePercentageMax = $visiblePercentageMax;
  }
  public function getVisiblePercentageMax()
  {
    return $this->visiblePercentageMax;
  }
  public function setVisiblePercentageMin(Google_Service_TagManager_Parameter $visiblePercentageMin)
  {
    $this->visiblePercentageMin = $visiblePercentageMin;
  }
  public function getVisiblePercentageMin()
  {
    return $this->visiblePercentageMin;
  }
  public function setWaitForTags(Google_Service_TagManager_Parameter $waitForTags)
  {
    $this->waitForTags = $waitForTags;
  }
  public function getWaitForTags()
  {
    return $this->waitForTags;
  }
  public function setWaitForTagsTimeout(Google_Service_TagManager_Parameter $waitForTagsTimeout)
  {
    $this->waitForTagsTimeout = $waitForTagsTimeout;
  }
  public function getWaitForTagsTimeout()
  {
    return $this->waitForTagsTimeout;
  }
  public function setWorkspaceId($workspaceId)
  {
    $this->workspaceId = $workspaceId;
  }
  public function getWorkspaceId()
  {
    return $this->workspaceId;
  }
}

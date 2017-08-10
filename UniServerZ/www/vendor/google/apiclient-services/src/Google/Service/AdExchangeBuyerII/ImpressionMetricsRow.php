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

class Google_Service_AdExchangeBuyerII_ImpressionMetricsRow extends Google_Model
{
  protected $availableImpressionsType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $availableImpressionsDataType = '';
  protected $bidRequestsType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $bidRequestsDataType = '';
  protected $inventoryMatchesType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $inventoryMatchesDataType = '';
  protected $responsesWithBidsType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $responsesWithBidsDataType = '';
  protected $rowDimensionsType = 'Google_Service_AdExchangeBuyerII_RowDimensions';
  protected $rowDimensionsDataType = '';
  protected $successfulResponsesType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $successfulResponsesDataType = '';

  public function setAvailableImpressions(Google_Service_AdExchangeBuyerII_MetricValue $availableImpressions)
  {
    $this->availableImpressions = $availableImpressions;
  }
  public function getAvailableImpressions()
  {
    return $this->availableImpressions;
  }
  public function setBidRequests(Google_Service_AdExchangeBuyerII_MetricValue $bidRequests)
  {
    $this->bidRequests = $bidRequests;
  }
  public function getBidRequests()
  {
    return $this->bidRequests;
  }
  public function setInventoryMatches(Google_Service_AdExchangeBuyerII_MetricValue $inventoryMatches)
  {
    $this->inventoryMatches = $inventoryMatches;
  }
  public function getInventoryMatches()
  {
    return $this->inventoryMatches;
  }
  public function setResponsesWithBids(Google_Service_AdExchangeBuyerII_MetricValue $responsesWithBids)
  {
    $this->responsesWithBids = $responsesWithBids;
  }
  public function getResponsesWithBids()
  {
    return $this->responsesWithBids;
  }
  public function setRowDimensions(Google_Service_AdExchangeBuyerII_RowDimensions $rowDimensions)
  {
    $this->rowDimensions = $rowDimensions;
  }
  public function getRowDimensions()
  {
    return $this->rowDimensions;
  }
  public function setSuccessfulResponses(Google_Service_AdExchangeBuyerII_MetricValue $successfulResponses)
  {
    $this->successfulResponses = $successfulResponses;
  }
  public function getSuccessfulResponses()
  {
    return $this->successfulResponses;
  }
}

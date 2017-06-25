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

class Google_Service_AdExchangeBuyerII_BidMetricsRow extends Google_Model
{
  protected $bidsType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $bidsDataType = '';
  protected $bidsInAuctionType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $bidsInAuctionDataType = '';
  protected $billedImpressionsType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $billedImpressionsDataType = '';
  protected $impressionsWonType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $impressionsWonDataType = '';
  protected $rowDimensionsType = 'Google_Service_AdExchangeBuyerII_RowDimensions';
  protected $rowDimensionsDataType = '';
  protected $viewableImpressionsType = 'Google_Service_AdExchangeBuyerII_MetricValue';
  protected $viewableImpressionsDataType = '';

  public function setBids(Google_Service_AdExchangeBuyerII_MetricValue $bids)
  {
    $this->bids = $bids;
  }
  public function getBids()
  {
    return $this->bids;
  }
  public function setBidsInAuction(Google_Service_AdExchangeBuyerII_MetricValue $bidsInAuction)
  {
    $this->bidsInAuction = $bidsInAuction;
  }
  public function getBidsInAuction()
  {
    return $this->bidsInAuction;
  }
  public function setBilledImpressions(Google_Service_AdExchangeBuyerII_MetricValue $billedImpressions)
  {
    $this->billedImpressions = $billedImpressions;
  }
  public function getBilledImpressions()
  {
    return $this->billedImpressions;
  }
  public function setImpressionsWon(Google_Service_AdExchangeBuyerII_MetricValue $impressionsWon)
  {
    $this->impressionsWon = $impressionsWon;
  }
  public function getImpressionsWon()
  {
    return $this->impressionsWon;
  }
  public function setRowDimensions(Google_Service_AdExchangeBuyerII_RowDimensions $rowDimensions)
  {
    $this->rowDimensions = $rowDimensions;
  }
  public function getRowDimensions()
  {
    return $this->rowDimensions;
  }
  public function setViewableImpressions(Google_Service_AdExchangeBuyerII_MetricValue $viewableImpressions)
  {
    $this->viewableImpressions = $viewableImpressions;
  }
  public function getViewableImpressions()
  {
    return $this->viewableImpressions;
  }
}

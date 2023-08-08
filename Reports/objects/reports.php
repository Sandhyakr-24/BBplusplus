<?php

    class reports {
        
        private $intReportId;
        private $strReportName;
        private $intUserId;
        private $strReportDesc;
        private $strUniqueId;
        
        private $intReportColumnId;
        private $intMyReportColumnId;
        private $intMyReportId;
        private $intMyReportWCId;
        private $intReportWCSeqId;
        private $strWCColumnName;
        private $strWCColumnLabel;
        private $strReportOperator;
        private $strReportWCValue1;
        private $strReportWCValue2;    
        private $strViewName;
        private $strViewType; //default or advanced
        private $intMyColumnSeqId;
        private $intOrderbySeqId;
        
        function setViewType($strViewType){
            $this->strViewType = $strViewType;
        }
        
        function getViewType(){
            return $this->strViewType;
        }
        
        function setOrderbySeqId($intOrderbySeqId){
            $this->intOrderbySeqId = $intOrderbySeqId;
        }
        
        function getOrderBySeqId(){
            return $this->intOrderbySeqId;
        }
        
        function setMyColumnSeqId($intMyColumnSeqId){
            $this->intMyColumnSeqId = $intMyColumnSeqId;
        }
        
        function getMyColumnSeqId(){
            return $this->intMyColumnSeqId;
        }
        
        
        
        function setViewName($strViewName){
            $this->strViewName = $strViewName;
        }
        
        function getViewName(){
            return $this->strViewName;
        }
        
        
        function setReportId($intReportId) {
            $this->intReportId = $intReportId;
        }
        
        function getReportId(){
            return $this->intReportId;
        }
        
        function setReportName($strReportName){
            $this->strReportName = $strReportName;
        }
        
        function getReportName(){
            return $this->strReportName;
        }
        
        function setUserid($intUserId){
            $this->intUserId=$intUserId;
        }
        
        function getUserId(){
            return $this->intUserId;
        }
        
        function setReportDesc($strReportDesc){
            $this->strReportDesc = $strReportDesc;
        }
        
        function getReportDesc(){
            return $this->strReportDesc;
        }
        
        function setUniqueId($strUniqueId){
            $this->strUniqueId = $strUniqueId;
        }
        
        function getUniqueId(){
            return $this->strUniqueId;
        }
        
        function setReportColumnId($intReportColumnId){
            $this->intReportColumnId = $intReportColumnId;
        }
        
        function getReportColumnId(){
            return $this->intReportColumnId;
        }
        
        function setMyReportColumnId($intMyReportColumnId){
            $this->intMyReportColumnId = $intMyReportColumnId;
        }
        
        function getMyReportColumnId(){
            return $this->intMyReportColumnId;
        }
        
        function setMyReportId($intMyReportId){
            $this->intMyReportId=$intMyReportId;
        }
        
        function getMyReportId(){
            return $this->intMyReportId;
        }
        
        function setReportWCSeqId($intReportWCSeqId){
            $this->intReportWCSeqId = $intReportWCSeqId;
        }
        
        function getReportWCSeqId(){
            return $this->intReportWCSeqId;
        }
        
        function setWCColumnName($strWCColumnName){
            $this->strWCColumnName = $strWCColumnName;
        }
        
        function getWCColumnName(){
            return $this->strWCColumnName;
        }
        
        function setWCColumnLabel($strWCColumnLabel){
            $this->strWCColumnLabel = $strWCColumnLabel;
        }
        
        function getWCColumnLabel(){
            return $this->strWCColumnLabel;
        }
        
        function setReportOperator($strReportOperator){
            $this->strReportOperator = $strReportOperator;    
        }
        
        function getReportOperator(){
            return $this->strReportOperator;
        }
        
        function setReportWCValue1($strReportWCValue1){
            $this->strReportWCValue1 = $strReportWCValue1;
        }
        
        function getReportWCValue1(){
            return $this->strReportWCValue1;
        }
        
        function setReportWCValue2($strReportWCValue2) {
            $this->strReportWCValue2 = $strReportWCValue2;
        }
        
        function getReportWCValue2(){
            return $this->strReportWCValue2;
        }
        
        
    }
?>

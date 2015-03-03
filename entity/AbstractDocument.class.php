<?php
/**
 * MongoDB Abstract Document Class Representation
 *
 * @author: Eng. YOSSA DJENGOUE Judicaël senior software developer at itkamer ltd
 * @email: judicael.yossa@itkamer.com / judicael.yossa@polytechnique.cm
 * @phone: (+00237) 679-635-319 / 699-580-614
 * @address: Molyko, Buea, South East, Cameroon.
 */

require_once 'IDocument.class.php';

abstract class AbstractDocument implements IDocument {
    
    protected $_array;
    protected $_cache;

    public function __construct() {
        $this->_array = array();
        $this->_cache = array();
    }
    
    public function append($key, $value) {
        if($value instanceof IDocument){
            $this->_array[$key] = $value->getDocument();
        }else{
            $this->_array[$key] = $value;
        }
        return $this;
    }
    
    public function set($key, $value) {
        if(array_key_exists($key,$this->_array)){
            $this->_array[$key] = $value;
            return $this;
        }else{
            trigger_error('key <b>'.$key.'</b> not exists in document');
        }
    }

    public function unsetField($key) {
        if(array_key_exists($key,$this->_array)){
            unset($this->_array[$key]);
        }
        return $this;
    }
    
    public function where($key, $value){
        $this->_cache[$key]=$value;
        return $this;
    }
    
    public function get($key){
        if(array_key_exists($key,$this->_array)){
            return $this->_array[$key];
        }else{
            trigger_error('key <b>'.$key.'</b> not exists in document');
        }
    }
    
    public function getDocument() {
        return $this->_array;
    }

    public function getOldDocument() {
        return $this->_cache;
    }

    public function initialiseCache() {
        foreach ($this->_cache as $key => $value) {
            $this->_array[$key] = $value;
        }
        $this->_cache = array();
    }
    
    public function init(){
        $this->_array = array();
        $this->_cache = array();
    }

    public function exists($key) {
        return array_key_exists($key, $this->_array);
    }
    
    public function whereAll($criteria) {
        if($criteria instanceof IDocument){
            $this->_cache = $criteria->getDocument();
        }else{
            $this->_cache= $criteria;
        }
        return $this;
    }
    
    public function appendAll($data) {
        if($data instanceof IDocument){
            foreach($data->getDocument() as $key => $value) {
                $this->_array[$key] = $value;
            }
        }else{
            foreach($data as $key => $value) {
                $this->_array[$key] = $value;
            }
        }
        return $this;
    }
    
    /**
     * Envoyer les conditions sous forme de tableau association a un element chacun.
     * @return \AbstractDocument
     */
    public function appendOr() {
        $condKeysValues = array();
        foreach (func_get_args() as $params) {
            $keyVal = array();
            if($params instanceof IDocument){
                $keyVal[array_keys($params->getDocument())[0]] = array_values($params->getDocument())[0];
            }else{
                $keyVal[array_keys($params)[0]] = array_values($params)[0];
            }
            $condKeysValues[] = $keyVal;
        }
        $this->_array['$or'] = $condKeysValues;
        return $this;
    }
    
    /**
     * Envoyer les conditions sous forme de tableau association a un element chacun.
     * @return \AbstractDocument
     */
    public function appendAnd() {
        $condKeysValues = array();
        foreach (func_get_args() as $params) {
            $keyVal = array();
            if($params instanceof IDocument){
                $keyVal[array_keys($params->getDocument())[0]] = array_values($params->getDocument())[0];
            }else{
                $keyVal[array_keys($params)[0]] = array_values($params)[0];
            }
            $condKeysValues[] = $keyVal;
        }
        $this->_array['$and'] = $condKeysValues;
        return $this;
    }
    
}

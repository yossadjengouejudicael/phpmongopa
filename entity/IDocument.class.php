<?php
/**
 * MongoDB Interface Document Representation
 *
 * @author: Eng. YOSSA DJENGOUE Judicaël senior software developer at itkamer ltd
 * @email: judicael.yossa@itkamer.com / judicael.yossa@polytechnique.cm
 * @phone: (+00237) 679-635-319 / 699-580-614
 * @address: Molyko, Buea, South East, Cameroon.
 */
interface IDocument {
    public function append($key, $value);
    public function getDocument();
    public function set($key, $value);
    public function where($key, $value);
    public function get($key);
    public function unsetField($key);
    public function initialiseCache();
    public function getOldDocument();
    public function init();
    public function exists($key);
    public function whereAll($criteria);
    public function appendAll($data);
    public function appendOr();
    public function appendAnd();
}

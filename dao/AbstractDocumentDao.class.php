<?php
/**
 * MongoDB Abstract Document DAO Representation
 *
 * @author: Eng. YOSSA DJENGOUE Judicaël senior software developer at itkamer ltd
 * @email: judicael.yossa@itkamer.com / judicael.yossa@polytechnique.cm
 * @phone: (+00237) 679-635-319 / 699-580-614
 * @address: Molyko, Buea, South East, Cameroon.
 */

require_once 'IDocumentDao.class.php';

abstract class AbstractDocumentDao implements IDocumentDao{
    
    protected $_col;
    
    public function __construct($_col) {
        $this->_col = $_col;
    }

    public function add(\IDocument $document) {
        $this->_col->insert($document->getDocument());
    }

    public function delete(\IDocument $document) {
        $this->_col->remove($document->getDocument());
    }

    public function find(\IDocument $document, \IDocument $projection = null) {
        if(is_null($projection)){
            $projection = new Document();
        }
        return $this->_col->find($document->getDocument(),$projection->getDocument());
    }

    public function findAll($skip, $limit, \IDocument $projection = null) {
        if(is_null($projection)){
            $projection = new Document();
        }
        
        return $this->_col->find(array(),$projection->getDocument())->skip($skip)->limit($limit);
    }
    
    public function findOne(\IDocument $document, \IDocument $projection=null){
        if(is_null($projection)){
            $projection = new Document();
        }
        return $this->_col->findOne($document->getDocument(),$projection->getDocument());
    }
    
    public function findById($id, \IDocument $projection = null) {
        if(is_null($projection)){
            $projection = new Document();
        }
        $criteria = new Document();
        $mongoId = new MongoId($id);
        $criteria->append("_id", $mongoId);
        return $this->_col->findOne($criteria->getDocument(),$projection->getDocument());
    }

    public function update(\IDocument $document) {
        $doc = new Document();
        $doc->append('$set', $document->getDocument());
        $this->_col->update($document->getOldDocument(), $doc->getDocument());
        $document->initialiseCache();
    }
    
    public function addToSet(\IDocument $document) {
        $doc = new Document();
        $doc->append('$addToSet', $document->getDocument());
        $this->_col->update($document->getOldDocument(), $doc->getDocument());
        $document->initialiseCache();
    }
    
    public function unsetField(\IDocument $document) {
        $doc = new Document();
        $doc->append('$unset', $document->getDocument());
        $this->_col->update($document->getOldDocument(), $doc->getDocument());
        $document->initialiseCache();
    }

    public function count() {
        return $this->_col->count();
    }
}

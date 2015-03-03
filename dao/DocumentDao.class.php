<?php
/**
 * MongoDB Document DAO Representation
 *
 * @author: Eng. YOSSA DJENGOUE Judicaël senior software developer at itkamer ltd
 * @email: judicael.yossa@itkamer.com / judicael.yossa@polytechnique.cm
 * @phone: (+00237) 679-635-319 / 699-580-614
 * @address: Molyko, Buea, South East, Cameroon.
 */

require_once 'AbstractDocumentDao.class.php';

class DocumentDao extends AbstractDocumentDao{

    public function __construct($_col) {
        parent::__construct($_col);
    }
    
}

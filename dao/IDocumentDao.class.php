<?php
/**
 * MongoDB Interface Document DAO Representation
 *
 * @author: Eng. YOSSA DJENGOUE Judicaël senior software developer at itkamer ltd
 * @email: judicael.yossa@itkamer.com / judicael.yossa@polytechnique.cm
 * @phone: (+00237) 679-635-319 / 699-580-614
 * @address: Molyko, Buea, South East, Cameroon.
 */
interface IDocumentDao {
    public function add(IDocument $document);
    public function update(IDocument $document);
    public function delete(IDocument $document);
    public function findAll($skip, $limit,IDocument $projection);
    public function findById($id, IDocument $projection);
    public function findOne(IDocument $document, IDocument $projection);
    public function find(IDocument $document, IDocument $projection);
    public function count();
}

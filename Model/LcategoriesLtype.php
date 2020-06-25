<?php
class LcategoriesLtype extends LwikiAppModel{

    public $useTable = 'lcategories_ltypes';
    public $belongsTo = array('Lwiki.Ltypes', 'Lwiki.Lcategory');
}
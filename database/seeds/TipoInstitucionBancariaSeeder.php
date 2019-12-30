<?php

use Illuminate\Database\Seeder;
use App\TipoInstitucionBancaria;

class TipoInstitucionBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposReferenciaBancaria = array (
        	array('nombre' => 'Banamex', 		  'codigo' => '.BNX'),
            array('nombre' => 'Bancomer', 		  'codigo' => '.BC'),
            array('nombre' => 'Santander',    	  'codigo' => '.STD'),
            array('nombre' => 'American Express', 'codigo' => '.AMEX'),
            array('nombre' => 'Scotia Bank', 	  'codigo' => '.SCB'),
            array('nombre' => 'Hong Kong Shan gain Bank Corporation', 	'codigo' => '.HSBC'),
            array('nombre' => 'Banjercito',    	  'codigo' => '.BJC'),
            array('nombre' => 'El que da la cara y cumple con su palabra (palabra Nahúatl)',    		'codigo' => '.IXE'),
            array('nombre' => 'Banorte', 		  'codigo' => '.BNT'),
            array('nombre' => 'Banco Inbursa', 	  'codigo' => '.BI'),
            array('nombre' => 'Banco Walmart',    'codigo' => '.BW'),
            array('nombre' => 'Banco Azteca',     'codigo' => '.BA'),
            array('nombre' => 'Banco del Bajío',  'codigo' => '.BB'),
        );

        TipoInstitucionBancaria::insert($tiposReferenciaBancaria);
    }
}

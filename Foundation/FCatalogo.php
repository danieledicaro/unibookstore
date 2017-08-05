<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 31/07/17
 * Time: 10.14
 */

class FCatalogo extends Fdb {

    public function __construct() {
        parent::__construct();
        $this->_table='Annuncio';
        $this->_key= 'id_annuncio';
        $this->_return_class='EAnnuncio';
        $this->_auto_increment=true;
    }

    /**
     * Funziona, l'array $a è un array con parametri di ricerca del tipo array(array(valori), ordinamento, limite)
     * array(valorei)=[parola chiave (stringa), anno_stampa (int), citta_consegna (string), se_spedisce (0 o 1), condizione (da 0 a 5), prezzo (int)]
     * inserendo la condizione mostra solo condizioni uguali o migliori
     * inserendo un prezzo cercherà in un range di +/- 10 dal prezzo inserito
     *
     * @param array $a
     * @return array|bool
     */
    public function search(array $a) {
        $filtro='';
        $b=$a[0];
        if (count($b)==1) {
            $query = "SELECT DISTINCT `".$this->_table.'`.* '.
                "FROM `Annuncio`, `Libro`, `CasaEditrice`, `Autore`, `AutoreLibro`, `Corso`, `Professore`, `Universita` ".
                "WHERE `Annuncio`.descrizione LIKE '%".$b[0]."%' OR `Libro`.titolo LIKE '%".$b[0]."%' OR `Libro`.isbn = '".$b[0].
                "' OR `CasaEditrice`.nome LIKE "."'%".$b[0]."%' OR `Autore`.nome LIKE '%".$b[0]."%' OR `Universita`.nome LIKE '%".$b[0].
                "%' OR `Professore`.nome LIKE '%".$b[0]."%' OR `Corso`.nome LIKE '%".$b[0]."%' AND ";
        }
        else {
            if ( $b[0]!=''){
                $query="SELECT DISTINCT `".$this->_table.'`.* '.
                    "FROM `Annuncio`, `Libro`, `CasaEditrice`, `Autore`, `AutoreLibro`, `Corso`, `Professore`, `Universita` ".
                    "WHERE `Annuncio`.descrizione LIKE '%".$b[0]."%' OR `Libro`.titolo LIKE '%".$b[0]."%' OR `Libro`.isbn = '".$b[0].
                    "' OR `CasaEditrice`.nome LIKE "."'%".$b[0]."%' OR `Autore`.nome LIKE '%".$b[0]."%' OR `Universita`.nome LIKE '%".$b[0].
                    "%' OR `Professore`.nome LIKE '%".$b[0]."%' OR `Corso`.nome LIKE '%".$b[0]."%'";
            }
            else $query='SELECT DISTINCT `'.$this->_table.'`.* '.
                'FROM `Annuncio`, `Libro`, `CasaEditrice`, `Autore`, `AutoreLibro`, `Corso`, `Professore`, `Universita`, `Citta` '.
                'WHERE ';
            for( $i = 1 ; $i < count($b) ; ++$i ){
                if($i==1 && $b[$i]!='') $filtro .= "`Libro`.anno_stampa = ".$b[$i]." AND";
                elseif ($i==2 && $b[$i]!='') $filtro .= "`Annuncio`.citta_consegna = `Citta`.id_citta AND `Citta`.comune = '".$b[$i]."' AND";
                elseif ($i==3 && $b[$i]!='') $filtro .= "`Annuncio`.se_spedisce = ".$b[$i]." AND";
                elseif ($i==4 && $b[$i]!='') $filtro .= "`Annuncio`.condizione > ".$b[$i]." AND";
                elseif ($b[$i]!='') $filtro .= "`Annuncio`.prezzo ".$b[$i]."-10 <= ".$b[$i]." <= 10+".$b[$i]." AND";
            }
            if ($filtro != '')
                $query.=substr($filtro, 0, strlen($filtro)-3);
            if ($filtro == '')
                $query=substr($query, 0, strlen($query)-5);
            if ($a[1] != '')
                $query.='ORDER BY '.$a[1].' ';
            if ($a[2] != '')
                $query.='LIMIT '.$a[2].' ';
        }
        $this->doQuery($query);
        $catalogo = new ECatalogo();
        $catalogo->setCatalogo($this->getObjectArray());
        return $catalogo;
    }

}

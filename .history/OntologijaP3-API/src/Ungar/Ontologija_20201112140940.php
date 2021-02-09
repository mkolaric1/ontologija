<?php

namespace Ungar;

/**
 * @Entity @Table(name="ontologija")
 **/


class Ontologija
{
    /** @id @Column(type="integer") @GeneratedValue **/
    protected $sifra;

    /**
    * @Column(type="string")
    */
    private $gost;

    /**
    * @Column(type="string")
    */
    private $podcast;

    /**
    * @Column(type="string")
    */
    private $voditelj;

    /**
    * @Column(type="string")
    */
    private $anotacija;

  public function getSifra(){
		return $this->sifra;
	}

	public function setSifra($sifra){
		$this->sifra = $sifra;
	}

  public function getNaziv(){
		return $this->naziv;
	}

	public function setNaziv($naziv){
		$this->naziv = $naziv;
	}

  public function getTip(){
    return $this->tip;
  }

  public function setTip($tip){
		$this->tip = $tip;
	}

  public function getOpis(){
  	return $this->opis;
  }

  public function setOpis($opis){
		$this->opis = $opis;
	}

  public function getAnotacija(){
    return $this->anotacija;
  }

  public function setAnotacija($anotacija){
    $this->anotacija = $anotacija;
  }

  public function setPodaci($podaci)
	{
		foreach($podaci as $kljuc => $vrijednost){
			$this->{$kljuc} = $vrijednost;
		}
	}

}



?>

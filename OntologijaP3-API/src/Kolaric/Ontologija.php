<?php

namespace Kolaric;

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
    private $nazivPodcasta;

   /**
    * @Column(type="string")
    */
    private $voditelj;

    /**
    * @Column(type="integer")
    */
    private $brojPregleda;

    /**
    * @Column(type="string")
    */
    private $podcastTrajanje;


    /**
    * @Column(type="string")
    */

    private $uriPodcasta;



    

    public function getSifra(){
      return $this->sifra;
    }
  
    public function setSifra($sifra){
      $this->sifra = $sifra;
    }
  
    public function getNazivPodcasta(){
      return $this->nazivPodcasta;
    }
  
    public function setNazivPodcasta($nazivPodcasta){
      $this->nazivPodcasta = $nazivPodcasta;
    }
  
    public function getVoditelj(){
      return $this->voditelj;
    }
  
    public function setVoditelj($voditelj){
      $this->voditelj = $voditelj;
    }
  
    public function getBrojPregleda(){
      return $this->brojPregleda;
    }
  
    public function setBrojPregleda($brojPregleda){
      $this->brojPregleda = $brojPregleda;
    }
  
    public function getPodcastTrajanje(){
      return $this->podcastTrajanje;
    }
  
    public function setPodcastTrajanje($podcastTrajanje){
      $this->podcastTrajanje = $podcastTrajanje;
    }
  
    public function getUriPodcasta(){
      return $this->uriPodcasta;
    }
  
    public function setUriPodcasta($uriPodcasta){
      $this->uriPodcasta = $uriPodcasta;
    }

    

    


    public function setPodaci($podaci)
    {
      foreach($podaci as $kljuc => $vrijednost){
        $this->{$kljuc} = $vrijednost;
      }
    }
    
  }

?>
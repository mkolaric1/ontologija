<?php
require 'vendor/autoload.php';
require 'bootstrap.php';
use Ungar\Ontologija;
use Ungar\Projekt;
use Composer\Autoload\ClassLoader;

Flight::route('/', function(){

  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20192020/mkolaric_19/kolaric.rdf'); // ovdje ide link na vašu oziz rdf datoteku (kad je stavite preko filezille)
  $info = $foaf->dump();
  echo "<h2>Ontologija P3 zadatka:</h2> <br/><br/>" . $info;
});

Flight::route('GET /search', function(){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Ungar\Ontologija');
  $zapisi = $repozitorij->findAll();
  echo $doctrineBootstrap->getJson($zapisi);
});


Flight::route('GET /fill_table', function(){

  $foaf = \EasyRdf\Graph::newAndLoad('http://bornaungar.me/ungar.rdf');
  foreach ($foaf->resources() as $resource) {

    $name = $foaf->get($resource, 'foaf:name'); // kako izvući foaf:name resursa, samo promijenite foaf:name ako vaša ontologija koristi nešto drugo za nazive
    //$type = $foaf->get($resource, 'rdf:type'); ovako $type uvijek bude NamedIndividual jer ih može biti više a on je u mojoj ontologiji uvijek prvi po defaultu, treba petlja

    if($name != ''){

      $i = 0;
      $types[] = [];
      $annotations = "";

      foreach ($resource->types() as $key) { // kako izvući sve rdf:type pojedinog resursa i staviti ih u array
        $types[$i] = $key;
        $i++;
      }

      if(count($types)>1){ // svima je po defaultu rdf:type NamedIndividual (pretpostavljam), a ovako ako ih resurs ima više od 1, zabilježit će drugi koji će bolje opisivati resurs. Nije potrebno jer je NamedIndividual i dalje točno.
        $myType = $types[1];
      }else{
        $myType = $types[0];
      }
      $description = $foaf->get($resource, 'dc:description'); // kako izvući dc:description resursa

      foreach ($resource->properties() as $key) {
          $annotations .= $key . ': ' . $foaf->get($resource, $key) . "\n"; // kako izvući sve anotacije resursa i spojiti u jedan string; "\n" služi da bi u androidu radio newline za svaku anotaciju
      }

      $ontologija = new Ontologija();
      $ontologija->setPodaci(Flight::request()->data);

      $ontologija->setNaziv($name); //tu stavljate svoje varijable.
      $ontologija->setTip($myType);
      $ontologija->setOpis($description);
      $ontologija->setAnotacija($annotations);

      $doctrineBootstrap = Flight::entityManager();
      $em = $doctrineBootstrap->getEntityManager();

      $em->persist($ontologija);
      $em->flush();

      /*
      //Prije nego što sam poslao podatke u bazu, prvo bi isprobao neku metodu iz dokumentacije i vidio što bi mi ispisalo.
      Preporučam da tek kada nađete to što trebate onda šaljite u bazu. Dotad zakomentirajte ovaj persist i flush gore, a dolje
      umjesto mojih name type i annotations, provjerite vaše podatke iz ontologije (naravno trebat će prilagoditi i gornje
      metode pošto imamo drukčije ontologije). //

      echo $name .'<br/>';
      echo $types[1] .'<br/>';
      echo $annotations;
      echo '<br/>';
      */
    }
  }

  echo "U bazu je uspješno unijeta ontologija.";

});

Flight::route('GET /search/@name', function($name){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Ungar\Ontologija');
  //$zapisi = $repozitorij->findBy(array('naziv' => $name)); // prvo što sam probao ali nije radilo parcijalno traženje, morala bi se podudarat cijela riječ
  $zapisi = $repozitorij->createQueryBuilder('p')
                        ->where('p.naziv LIKE :naziv')
                        ->setParameter('naziv', '%'.$name.'%')
                        ->getQuery()
                        ->getResult();  // https://stackoverflow.com/questions/12706337/doctrine-2-query-with-like/12706380
  echo $doctrineBootstrap->getJson($zapisi);

});

$cl = new ClassLoader('Ungar', __DIR__, '/src');
$cl->register();
require_once 'bootstrap.php';
Flight::register('entityManager', 'DoctrineBootstrap');

Flight::start();

// Ontologije su nam svima slične, ali će trebati neku drugu kombinaciju metoda uvjeta i stringova, evo potencijalne linije koje će vam pomoći
/* Sva svojstva (tj. anotacije prema Protegeu)
foreach ($resource->properties() as $key) {
    echo $i++ . ' ' . $key . ' <br/>';
}
*/

/* Kako maknuti sve iz linka ispred # hashtaga
$url = parse_url($type);
$type2 = $url["fragment"];
*/

/* Svi tipovi
foreach ($resource->types() as $key) {
    echo $i++ . ' ' . $key . ' <br/>';
}
*/

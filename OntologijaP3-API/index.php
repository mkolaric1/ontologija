<?php
require 'vendor/autoload.php';
require 'bootstrap.php';

use Kolaric\Ontologija;
use Composer\Autoload\ClassLoader;

Flight::route('/', function () {

  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20192020/mkolaric_19/ontologija/kolaric.rdf'); // ovdje ide link na vašu oziz rdf datoteku (kad je stavite preko filezille)
  $info = $foaf->dump();
  echo "<h2>Ontologija P3 zadatka:</h2> <br/><br/>" . $info;
});

Flight::route('GET /search', function () {

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij = $em->getRepository('Kolaric\Ontologija');
  $zapisi = $repozitorij->findAll();
  echo $doctrineBootstrap->getJson($zapisi);
});


Flight::route(
  'GET /fill_table',
  function () {

    //$foaf
    $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20192020/mkolaric_19/ontologija/kolaric.rdf');






    foreach ($foaf->resources() as $resource) {


      if ($foaf->get($resource, '<http://www.semanticweb.org/ja/ontologies/2021/0/untitled-ontology-10#broj_pregleda>') != '') {


        $brojPregleda = '' . $foaf->get($resource, "<http://www.semanticweb.org/ja/ontologies/2021/0/untitled-ontology-10#broj_pregleda>");
        $nazivPodcasta = '' . $foaf->get($resource, "<http://www.semanticweb.org/ja/ontologies/2021/0/untitled-ontology-10#naziv_podcasta>");
        $podcastTrajanje = '' . $foaf->get($resource, "<http://www.semanticweb.org/ja/ontologies/2021/0/untitled-ontology-10#podcast_trajanje>");
        $uriPodcasta = '' . $foaf->get($resource, "<http://www.semanticweb.org/ja/ontologies/2021/0/untitled-ontology-10#uri_podcasta>");
        $voditelj = '' . $foaf->get($resource, "<http://www.semanticweb.org/ja/ontologies/2021/0/untitled-ontology-10#voditelj>");



        $ontologija = new Ontologija();
        $ontologija->setPodaci(Flight::request()->data);

        $ontologija->setNazivPodcasta($nazivPodcasta); //tu stavljate svoje varijable.
        $ontologija->setVoditelj($voditelj);
        $ontologija->setBrojPregleda($brojPregleda);
        $ontologija->setPodcastTrajanje($podcastTrajanje);
        $ontologija->setUriPodcasta($uriPodcasta);



        $doctrineBootstrap = Flight::entityManager();
        $em = $doctrineBootstrap->getEntityManager();

        $em->persist($ontologija);
        $em->flush();
      }
    }



  }




);

Flight::route('GET /search/@nazivPodcasta', function ($nazivPodcasta) {

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij = $em->getRepository('Kolaric\Ontologija');
  //$zapisi = $repozitorij->findBy(array('naziv' => $name)); // prvo što sam probao ali nije radilo parcijalno traženje, morala bi se podudarat cijela riječ
  $zapisi = $repozitorij->createQueryBuilder('p')
    ->where('p.nazivPodcasta LIKE :nazivPodcasta')
    ->setParameter('nazivPodcasta', '%' . $nazivPodcasta . '%')
    ->getQuery()
    ->getResult();  // https://stackoverflow.com/questions/12706337/doctrine-2-query-with-like/12706380
  echo $doctrineBootstrap->getJson($zapisi);
});

$cl = new ClassLoader('Kolaric', __DIR__, '/src');
$cl->register();
require_once 'bootstrap.php';
Flight::register('entityManager', 'DoctrineBootstrap');

Flight::start();


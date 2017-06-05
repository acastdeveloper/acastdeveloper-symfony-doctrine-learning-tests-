<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//Per tal què faci servir l'entitat Curso, de doctrine, posem
use AppBundle\Entity\Curso;

class PruebasController extends Controller
{
    public function indexAction(Request $request, $name, $page)
    {

        //Definició de variables o matrius
        $productos =array(
          array("producto"=>"Consola 1","precio"=>2),
          array("producto"=>"Consola 2","precio"=>3),
          array("producto"=>"Consola 3","precio"=>4),
          array("producto"=>"Consola 4","precio"=>5),
          array("producto"=>"Consola 5","precio"=>6)
        );

        $fruta =array("manzana"=>"golden", "pera"=>"rica");

        //renderització
        return $this->render('AppBundle:Pruebas:index.html.twig', array(
          'texto' => $name."-".$page,
          'productos'=>$productos,
          'fruta'=>$fruta
        ));
    }


    public function createAction()
    {
        // Aquesta és l'acció d'inserir dades a la base de dades.
        // Per poder fer aquesta acció, abans hem: 
        // 1) Creat l'entitat curso. En aquest cas ho hem fet mitjançant l'ordre
        
          $curso = new Curso();
          // També podríem haver fet servir "$curso = new AppBundle\Entity\Curso();"
          // però no cal perquè més amunt hem fet servir "use AppBundle\Entity\Curso;"
          // Amb això crea un objecte instanciat de Curso, definit a l'entitat.

          $curso->setTitulo("Curswo de Symfony3 de Victor Robles");
          $curso->setDescripcion("Curso completo de Symfony3");
          $curso->setPrecio(80);
          //Definim propietats de $curso

          $em =$this->getDoctrine()->getManager();
          //Obre el gestor d'entitats per a $em
          $em->persist($curso);
          //Li fica l'objecte "curso" amb les propietats al gestor
          $flush=$em->flush();
          //Li aboca les propietats
          
      if($flush !=null)  {
        echo "El registro del curso no se ha creado bien";
      } else {
        echo "Registro del curso creado corretamente";
      }
          die();

    }


    public function readAction() {

      $em =$this->getDoctrine()->getManager();
      //Per gestionar les nostres entitats obrim el getEntityManager o getManager.

      $cursos_repo =$em->getRepository("AppBundle:Curso");
      //El repositori és l'objecte que ens permet seleccionar concretament amb quina "entitat" 
      //treballarem. Aquesta entitat és representant d'una taula a la base de dades.

      $cursos = $cursos_repo->findAll();
      //$cursos és un array, d'objectes, format per tots els registres de la taula cursos, perquè 
      //ha fet servir el mètode findAll(). Hi ha altres "find", com find(), findBy(), findOneBy() ,
      //Obteniendo Datos
      //Para obtener datos de las tablas tenemos varios métodos realmente mágicos:
      //findAll(): Obtiene todos los registros de la tabla. Retorna un array.
      //find(): Obtiene un registro a partir de la clave primaria de la tabla.
      //findBy(): Obtiene los registros encontrados pudiendo pasar como argumentos los valores que irían dentro del WHERE. Retorna un array.
      //findOneBy(): obtiene un registro pudiendo pasar como argumentos los valores que irían dentro del WHERE.
      //Més info: http://www.maestrosdelweb.com/curso-symfony2-manipulando-datos-con-doctrine/



      $curso_ochenta=$cursos_repo->findBy(array("precio"=>80));
      //$curso_ochenta és un array obtingut pels registres amb "precio" 80.
      //Es el equivalente a un WHERE de mysql
      //Me pasa un array de objetos, donde cada objeto es un registro de la tabla
      echo $curso_ochenta[3]->getTitulo();
      //M'imprimeix el títol del quart element de l'array format per objectes amb preu 80
      echo count($curso_ochenta);
      //Imprimeix tots els objectes(=registres) de preu 80.
      echo "<hr>";

      echo "<div style='border:1px solid red;padding:20px'>";
      $curso_ochentaB=$cursos_repo->findOneByPrecio(80);
      //En aquest cas, $curso_ochentaB, no és una matriu. És un únic objecte.
      //Per això no cal indicar cap índex
      //Ens treu el primer objecte(registre) que troba amb "precio" 80.
      echo $curso_ochentaB->getTitulo();
      echo "</div>";
      echo "<hr>";

      foreach($cursos as $curso) {
        echo $curso->getTitulo()."<br>";
        echo $curso->getDescripcion()."<br>";
        echo $curso->getPrecio()."<br><hr>";
      }


      die();

    }


    public function updateAction($id, $titulo, $descripcion, $precio) {
      //En aquesta funció li passarem els paràmetres: 
      //$id, $titulo, $descripcion, $precio

      $em =$this->getDoctrine()->getEntityManager();
      //Obre el gestor d'entitats
      $cursos_repo = $em->getRepository("AppBundle:Curso");
      //Selecciona el repositori amb qui treballarà

      $curso = $cursos_repo->find($id);
      //$curso és un objecte(registre) concret per aquella $id concreta i única 

      $curso->setTitulo($titulo);
      $curso->setDescripcion($descripcion);
      $curso->setPrecio($precio);
      //Estableix nous valors per aquell objecte(registre).


      $em->persist($curso);
      //Els guarda
      $flush=$em->flush();
      //Els aboca a la base de dades

      if($flush !=null)  {
        echo "La modificación ha fallado";
      } else {
        echo "Modifiación realizada corretamente";
      }

      die();

    }

    public function deleteAction($id) {
      //En aquesta funció li passarem el paràmetre $id

      $em =$this->getDoctrine()->getEntityManager();
      //Obre el gestor d'entitats
      $cursos_repo = $em->getRepository("AppBundle:Curso");
      //Escull el repositori(la taula) amb la que treballarem

      $curso = $cursos_repo->find($id);
      //$curso és l'objecte(registre) del repositori(la taula) 
      //concret amb la $id que li hem passat
      $em->remove($curso);
      //Li diem al gestor d'entitats que esborri aquest objecte del repositori

      $flush=$em->flush();
      //Amb aquesta ordre flush en haver esborrat l'objecte del repositori
      //transmetrà l'ordre a la base de dades perquè esborri el registre corresponent

      if($flush!=null) {
        echo "No se ha borrado bien!!";
      } else {
        echo "Borrado correctamente";
      }

      die();
    }



    public function nativeSqlAction() {
      //EXEMBLE DE FUNCIÓ PER FER CONSULTES AMB SQL "TRADICIONAL"
      $em =$this->getDoctrine()->getEntityManager();
      //Obre el gestor d'entitats
      $db=$em->getConnection();
      //Es connecta a la base de dades

      $query = 'SELECT * FROM cursos';
      //Defineix en llenguatge SQL una consulta.
      //En aquest cas està seleccionant tots els registres de la taula "cursos"
      $stmt = $db->prepare($query);
      //Prepara la consulta $stmt
      $params = array();
      //Inicialitza una matriu $params 

      $stmt->execute($params);
      //Executa la consulta $stmt

      $cursos = $stmt->fetchAll();
      //Ens tornarà un array d'arrays,
      //en comptes d'un array d'objectes

      foreach ($cursos as $curso) {
       //Amb foreach itera aquest array d'arrays 
        echo $curso["titulo"];
        //Al ser un array d'arrays per extreure el valor no fa servir 
        //la fletxa "->" si no els indexos ["titulo"]
        echo "-";
        echo $curso["descripcion"];
        echo "-";
        echo $curso["precio"];
        echo "<hr>";
      }

      die();

    }


    public function dqlAction() {
      //EXEMPLE DE FUNCIÓ AMB EL DIALECTE 
      //DE SQL PROPI DE DOCTRINE, EL DQL
      $em =$this->getDoctrine()->getEntityManager();
      //Obre el gestor d'entitats
      $query = $em->createQuery("
              SELECT c FROM AppBundle:Curso c
              /* Observacions:
              1) No està adreçant-se a la taula de la bbdd si no al repositori.
              2) Crec que en DQL no posa asterisc * darrera del select sino c, 
                  perquè és alies que posa a entitat Curso
               */
              WHERE c.precio > :precio
              /* Per evitar injeccions d'SQL fa servir lo dels dos punts, igual que amb PDO */
            ")->setParameter("precio","79");
      //Defineix la consulta amb un mètode de Doctrine anomenat
      //createQuery()
      $cursos = $query->getResult();
      //$cursos és la matriu d'objectes obtinguda amb el mètode getResult, 
      //crec que de DQL, que obté els resultats de la consulta en forma 
      //de matriu d'objectes
      
      foreach ($cursos as $curso) {
      //Itera la matriu d'objectes(registres) $cursos i a cada ítem l'anomena $curso
        echo $curso->getTitulo()."<br>";
        //Imprimeix de cada objecte $curso la seva propietat título
      }
      die();
    }


    

    public function queryBuilderAction() {
      $em =$this->getDoctrine()->getEntityManager();
      //Obre el gestor d'entitats
      $cursos_repo = $em->getRepository("AppBundle:Curso");
      //Accedeix al repositori/taula Curso.

      $query = $cursos_repo->createQueryBuilder("c")
              ->where("c.precio > :precio")
              ->setParameter("precio","79")
              ->getQuery();
      $cursos = $query->getResult();

      foreach ($cursos as $curso) {
        echo $curso->getTitulo()."<br>";
      }
      die();



    }


    public function queryCustomAction() {
      $em =$this->getDoctrine()->getEntityManager();
      //Obre el gestor d'entitats
      $cursos_repo = $em->getRepository("AppBundle:Curso");
      //Accedeix al repositori/taula Curso.

      
      $cursos = $cursos_repo->getCursos();

      foreach ($cursos as $curso) {
        echo $curso->getTitulo()."<br>";
      }
      die();



    }




} 









?> 
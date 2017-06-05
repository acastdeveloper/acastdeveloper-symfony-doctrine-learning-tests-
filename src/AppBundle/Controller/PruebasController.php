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
      //Obre el gestor d'entitats per a $em

      $cursos_repo =$em->getRepository("AppBundle:Curso");
      
      $cursos =$cursos_repo->findAll();

      $curso_ochenta=$cursos_repo->findBy(array("precio"=>80));
      //Es el equivalente a un WHERE de mysql
      //Me pasa un array de objetos, donde cada objeto es un registro de la tabla
      echo $curso_ochenta[3]->getTitulo();
      echo count($curso_ochenta);
      echo "<hr>";

      echo "<div style='border:1px solid red;padding:20px'>";
      $curso_ochentaB=$cursos_repo->findOneByPrecio(80);
      //Ens treu el primer que troba
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

      $em =$this->getDoctrine()->getEntityManager();
      $cursos_repo = $em->getRepository("AppBundle:Curso");

      $curso = $cursos_repo->find($id);
      $curso->setTitulo($titulo);
      $curso->setDescripcion($descripcion);
      $curso->setPrecio($precio);

      $em->persist($curso);
      $flush=$em->flush();

      if($flush !=null)  {
        echo "La modificación ha fallado";
      } else {
        echo "Modifiación realizada corretamente";
      }

      die();

    }

    public function deleteAction($id) {

      $em =$this->getDoctrine()->getEntityManager();
      $cursos_repo = $em->getRepository("AppBundle:Curso");

      $curso = $cursos_repo->find($id);
      $em->remove($curso);

      $flush=$em->flush();

      if($flush!=null) {
        echo "No se ha borrado bien!!";
      } else {
        echo "Borrado correctamente";
      }

      die();
    }



    public function nativeSqlAction() {
      $em =$this->getDoctrine()->getEntityManager();
      $db=$em->getConnection();

      $query = 'SELECT * FROM cursos';
      $stmt = $db->prepare($query);
      $params = array();
      $stmt->execute($params);
      $cursos = $stmt->fetchAll();
      //Ens tornarà un array d'arrays,
      //en comptes d'un array d'objectes

      foreach ($cursos as $curso) {
        echo $curso["titulo"];
        echo "-";
        echo $curso["descripcion"];
        echo "-";
        echo $curso["precio"];
        echo "<hr>";
      }



      die();

    }


    public function dqlAction() {
      $em =$this->getDoctrine()->getEntityManager();
      $query = $em->createQuery("
              SELECT c FROM AppBundle:Curso c
              WHERE c.precio > :precio
            ")->setParameter("precio","79");
      $cursos = $query->getResult();
      foreach ($cursos as $curso) {
        echo $curso->getTitulo()."<br>";
      }
      die();
    }


    

    public function queryBuilderAction() {
      $em =$this->getDoctrine()->getEntityManager();
      $cursos_repo = $em->getRepository("AppBundle:Curso");

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




} 









?> 
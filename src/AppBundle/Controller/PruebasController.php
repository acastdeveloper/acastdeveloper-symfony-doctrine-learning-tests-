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


    public function createAction() {

          $curso = new Curso();
          // $curso = new AppBundle\Entity\Curso();

          $curso->setTitulo("Curswo de Symfony3 de Victor Robles");
          $curso->setDescripcion("Curso completo de Symfony3");
          $curso->setPrecio(80);

          $em =$this->getDoctrine()->getManager();
          //Obre el gestor d'entitats per a $em
          $em->persist($curso);
          //Li fica les propietats de curso al gestor
          $flush=$em->flush();
          //Li avoca el paquet de propietats
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






}

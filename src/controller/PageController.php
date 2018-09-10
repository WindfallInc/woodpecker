<?php
/*
* THIS FILE SHOULD NOT BE EDITED
* This file will be overwritten if the cms updates
* to make changes to this file, duplicate it
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Template;
use App\Type;
use App\Content;
use App\Category;
use App\Row;
use App\Component;
use App\Menu;
use App\Nav;
use App\Event;
use App\Form;
use App\Question;
use App\Submission;
use App\Answer;


use Auth;
use Illuminate\Support\Facades\Input;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $page 	 = Content::where('slug','home')->where('published', 1)->first();
      if(!isset($page)){
        return 'Page not found';
      }
      if(isset($page->template)){
        $template = Template::where('slug',$page->template)->first();
      }
      else{
        $template = Template::where('slug','home-page')->first();
      }
      $summers = Content::with('type')->where('slug','itinerary')->with('categories')->where('slug','summer-itineraries')->get();
      return $summers;

      return view('templates.'.$template->slug, compact('page','template'));
    }

    public function home()
    {
      $page 	 = Content::where('slug','home')->where('published', 1)->first();
      if(!isset($page)){
        return 'Page not found';
      }
      if(isset($page->template)){
        $template = Template::where('slug',$page->template)->first();
      }
      else{
        $template = Template::where('slug','home-page')->first();
      }

      $summers = Category::with('contents')->where('slug','summer-itineraries')->first();
      $summers = $summers->contents;

      $winters = Category::with('contents')->where('slug','winter-itineraries')->first();
      $winters = $winters->contents;

      return view('templates.'.$template->slug, compact('page','template','summers','winters'));
    }

    public function page($slug){

        $page 	 = Content::where('slug',$slug)->where('published', 1)->with(['rows', 'components'])->first();

        if(!isset($page)){
          return 'Page not found';
        }
        $has_content = count($page->rows) + count($page->components);

        if(isset($page->template->id)){
          $template= $page->template;
        }
        else {
          $template = $page->type->templates->sortByDesc('updated_at')->first();
        }


        return view('templates.'.$template->slug, compact('page','template', 'has_content'));
    }
    public function pageByType($type,$slug){

        $type    = Type::where('slug',$type)->first();
        $page 	 = Content::where('slug',$slug)->where('type_id',$type->id)->where('published', 1)->with(['rows', 'components'])->first();

        if(!isset($page)){
          return 'Page not found';
        }
        $has_content = count($page->rows) + count($page->components);

        $template = $page->type->templates->first();

        return view('templates.'.$template->slug, compact('page','template', 'has_content'));
    }
    public function preview($slug){

        $page 	 = Content::where('slug',$slug)->first();

        if(!isset($page)){
          return 'Page not found';
        }
        $has_content = count($page->rows) + count($page->components);

        $template = $page->type->templates->first();

        return view('templates.'.$template->slug, compact('page','template', 'has_content'));

    }

    public function form($id){

        $form = Form::find($id);

        if(!isset($form)){
          return 'error - form is imaginary';
        }

        $submission = new Submission;
        $submission->form()->associate($form);
        $submission->save();

        foreach($form->questions as $question){
          $answer = new Answer;
          $answer->content = Input::get($question->slug);
          $answer->submission()->associate($submission);
          $answer->question()->associate($question);
          $answer->save();
        }


        return redirect($form->redirect);


    }

    public function search() {

  	  $search        = Input::get('search');
  	  if(isset($search)){
  	    $results       	= Content::where('title', 'like', '%'.$search.'%')->orWhere('keywords', 'like', '%'.$search.'%')->orWhere('metadesc', 'like', '%'.$search.'%')->orderBy('created_at','DESC')->get();
  	  }
  	  else{
  	    $results        = Content::inRandomOrder()->take(6)->get();
  	  }
  		if(count($results)>0){
  			$success=true;
  		}
  		else {
  			$results        = Content::inRandomOrder()->take(6)->get();
  		}
      $template = Template::find(1);

  	  return view('templates.results', compact('results','success','template'));
	  }

    public function loopContent($slug){

        $page 	 = Content::where('slug',$slug)->where('published', 1)->with(['rows', 'components'])->first();

        if(!isset($page)){
          return 'Page not found';
        }


        return view('includes.content-loop', compact('page','template','events', 'has_content'));
    }





}

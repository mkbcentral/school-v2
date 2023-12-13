<?php

namespace App\Livewire\Application\Settings;

use App\Models\AppLink;
use App\Models\SubAppLink;
use App\Models\User;
use Livewire\Component;

class AppLinkSettings extends Component
{
    public $listMainLink=[],$listSubLink=[],$linksSubSelected=[],$linksMainSelected=[];
    public $userData=null;
    public function mount(){
        $this->listSubLink=SubAppLink::orderBy('name','ASC')->get();
        $this->listMainLink=AppLink::orderBy('name','ASC')->get();
    }
    public function affecteSubLinks(){
        if ($this->linksSubSelected !=[]){
            $this->userData->subAppLinks()->detach($this->linksSubSelected);
            $this->userData->subAppLinks()->sync($this->linksSubSelected);
            $this->dispatch('added',['message'=>'Menu bien affécté']);
        }else{
            $this->dispatch('error',['message'=>'Aucun élément selectionné']);
        }
    }
    public function affecteMainLinks(){
        if ($this->linksMainSelected !=[]){
            $this->userData->appLinks()->detach($this->linksMainSelected);
            $this->userData->appLinks()->sync($this->linksMainSelected);
            $this->dispatch('added',['message'=>'Menu bien affécté']);
        }else{
            $this->dispatch('error',['message'=>'Aucun élément selectionné']);
        }
    }
    public function getUser(User $user){
        $this->userData=$user;
        $this->linksSubSelected=$user->subAppLinks()->pluck('sub_app_link_id')->map(function ($id){
            return (string) $id;
        });
        $this->linksMainSelected=$user->appLinks()->pluck('app_link_id')->map(function ($id){
            return (string) $id;
        });
    }
    public function render()
    {
        $listUser=User::where('school_id',auth()->user()->school->id)
            ->with(['appLinks'])
            ->with('subAppLinks')
                ->get();
        return view('livewire.application.settings.app-link-settings',['listUser'=>$listUser]);
    }
}

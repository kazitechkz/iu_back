<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use \Spatie\Searchable\Search as SearchModel;
class Search extends Component
{
    public $search = "";

    public $users;

    public $user_id;
    public $user_name;
    public bool $loading = false;

    public function mount($user_name)
    {
        $this->user_name = $user_name;
        $this->loading = false;
        $this->search = old("search")??"";
    }

    public function render()
    {
        return view('livewire.user.search');
    }

    public function search_user(){
        if(strlen($this->search) >= 3){
            $this->loading = true;
            $this->users = (new SearchModel())
                ->registerModel(User::class, ['name', 'username',"phone","email"])
                ->limitAspectResults(50)
                ->search($this->search);
            $this->loading = false;
        }
    }
}

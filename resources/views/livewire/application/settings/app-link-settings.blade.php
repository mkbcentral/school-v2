<div>
    <x-loading-indicator/>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-users-slash"></i> ATTRIBUTION DES DROITS AU MENU</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
           <div class="row">
               <div class="col-md-6">
                  <div class="card p-2">
                      @if ($listUser->isEmpty())
                          <span class="text-success text-center p-4">
                                <h4><i class="fa fa-database" aria-hidden="true"></i>
                                    Aucune donnée trouvée !
                                </h4>
                            </span>
                      @else
                          <h4 class="text-uppercase text-bold"><i class="fas fa-list"></i> Liste des utilisateur</h4>
                          <table class="table table-stripped">
                              <thead class="thead-light">
                              <tr class="text-uppercase">
                                  <th>Nom de l'utilisateur</th>
                                  <th class="text-center">Role</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($listUser as $user)
                                  <tr wire:click="getUser({{$user}})" class="{{$user?->id==$userData?->id?'bg-info':''}}">
                                      <td><i class="fas fa-user-circle"></i> {{ $user->name}}</td>
                                      <td class="text-center">{{ $user?->role?->name }}
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                      @endif
                  </div>
               </div>
               <div class="col-md-6">
                  @if($userData !=null)
                        <div class="card p-3">
                            <span class="text-bold text-info"><i class="fas fa-user"></i> Utilisateur: {{$userData->name}}</span>
                            <span class="text-bold text-primary"><i class="fas fa-key"></i> Role: {{$userData?->role?->name}}</span>
                        </div>
                       <div class="card">
                           <div class="card-header">
                               <h5 class="card-header-pills text-info"><i class="fas fa-link"></i> Menu principal</h5>
                           </div>
                           <div class="card-body">
                               <!-- Minimal style -->
                               <div class="row">
                                   @foreach($listMainLink as $appLink)
                                       <div class="col-sm-6">
                                           <!-- checkbox -->
                                           <div class="form-group clearfix">
                                               <div  class="icheck-primary d-inline">
                                                   <input type="checkbox" id="{{str_replace(' ', '',$appLink->name)}}"
                                                          wire:model="linksMainSelected" value="{{$appLink->id}}">
                                                   <label for="{{str_replace(' ', '',$appLink->name)}}"
                                                          class="">
                                                       {{$appLink->name}}
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                   @endforeach
                               </div>
                           </div>
                           <div class="card-footer d-flex justify-content-end">
                               <x-form.button wire:click="affecteMainLinks" type="button" class="btn btn-primary"><i class="fas fa-sync"></i> Attribuer</x-form.button>
                           </div>
                       </div>
                       <div class="card">
                           <div class="card-header">
                               <h5 class="card-header-pills text-info"><i class="fas fa-link"></i> Sous menu</h5>
                           </div>
                           <div class="card-body">
                               <!-- Minimal style -->
                               <div class="row">
                                   @foreach($listSubLink as $link)
                                       <div class="col-sm-6">
                                           <!-- checkbox -->
                                           <div class="form-group clearfix">
                                               <div  class="icheck-primary d-inline">
                                                   <input type="checkbox" id="{{$link->id}}"
                                                          wire:model="linksSubSelected" value="{{$link->id}}" {{$userData->subAppLinks()->pluck('sub_app_link_id')->contains($link->id)?'checked':''}}>
                                                   <label for="{{$link->id}}" class="">
                                                       {{$link->name}}
                                                   </label>
                                               </div>
                                           </div>
                                       </div>

                                   @endforeach
                               </div>
                           </div>
                           <div class="card-footer d-flex justify-content-end">
                               <x-form.button wire:click="affecteSubLinks" type="button" class="btn btn-info"><i class="fas fa-sync"></i> Attribuer</x-form.button>
                           </div>
                       </div>
                  @endif
               </div>
           </div>
        </div>
    </div>
</div>

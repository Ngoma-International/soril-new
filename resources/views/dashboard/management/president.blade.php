@extends('dashboard.layout.app')

@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Messages du Président</h3>
                                <div class="nk-block-des text-soft">
                                    <p>
                                        {{count($membres)}} Membre (s)
                                    </p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <a data-toggle="modal" data-target="#update" class="btn btn-white btn-outline-light">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>AJOUTER UN MESSAGE</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        @if(session('message'))
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-des">
                                        <div class="example-alert">
                                            <div class="alert alert-success alert-icon">
                                                <em class="icon ni ni-check-circle"></em> <strong>Successfully</strong>.
                                                {{session('message')}} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                <label class="custom-control-label" for="uid"></label>
                                            </div>
                                        </th>
                                        <th class="nk-tb-col"><span class="sub-text">Utilisateur</span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Titre de l'auteur</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Titre du message</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Date</span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($membres as $sec)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </td>

                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <img src="{{asset($sec->image)}}" style="width: 50%" alt="">
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{$sec->prenom . ' ' . $sec->nom}}
                                                            <span class="dot dot-success d-md-none ml-1"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$sec->titreAuteur}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$sec->titreMessage}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                                <ul class="list-status">
                                                    <li>
                                                        <span>{{$sec->date}}</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li class="nk-tb-action">
                                                        <a class="btn btn-trigger btn-icon" data-toggle="modal" data-target="#update-{{$sec->id}}">
                                                            <em class="icon ni ni-pen2"></em>
                                                        </a>
                                                    </li>
                                                    <li class="nk-tb-action">
                                                        <form action="{{ route('messages.destroy' , $sec->id)}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            {{ csrf_field() }}

                                                                <button type="submit" class="btn btn-primary">
                                                                    <em class="icon ni ni-trash-alt"></em>
                                                                </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr><!-- .nk-tb-item  -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="update-{{$sec->id}}">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                                    <div class="modal-body modal-body-lg">
                                                        <h5 class="title">Update Message</h5>
                                                        <ul class="nk-nav nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#personal">Informations</a>
                                                            </li>
                                                        </ul><!-- .nav-tabs -->
                                                        <form action="{{route('messages.update', $sec->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{ method_field('PUT') }}
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="personal">
                                                                    <div class="row gy-4">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="prenom">Prénom</label>
                                                                                <input type="text" class="form-control form-control-lg"
                                                                                       name="prenom" value="{{$sec->prenom}}"
                                                                                       placeholder="Enter name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="nom">Nom de famille</label>
                                                                                <input type="text" class="form-control form-control-lg"
                                                                                       name="nom" value="{{$sec->nom}}"
                                                                                       placeholder="Enter display name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="email">Titre de l'Auteur</label>
                                                                                <input type="text" class="form-control form-control-lg"
                                                                                       name="titreAuteur" value="{{$sec->titreAuteur}}"
                                                                                       placeholder="Titre here">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="phone">Date</label>
                                                                                <input type="datetime-local" class="form-control form-control-xl form-control-outlined"
                                                                                       name="date" value="{{$sec->date}}"
                                                                                       placeholder="Date">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="phone">Titre Message</label>
                                                                                <input type="text" class="form-control form-control-lg"
                                                                                       name="titreMessage" value="{{$sec->titreMessage}}"
                                                                                       placeholder="Titre Message">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="phone">Introduction</label>
                                                                                <input type="text" class="form-control form-control-lg"
                                                                                       name="introduction" value="{{$sec->introduction}}"
                                                                                       placeholder="Introduction here">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="default-textarea">Bio</label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea class="form-control no-resize"
                                                                                              name="about">
                                                                                        {{$sec->about}}
                                                                                    </textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="default-textarea">Corps du Message</label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea class="form-control no-resize"
                                                                                              name="message">
                                                                                        {{$sec->message}}
                                                                                    </textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="default-06">Photos</label>
                                                                                <div class="form-control-wrap">
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               multiple class="custom-file-input"
                                                                                               accept="image/png, image/jpeg"
                                                                                               name="file">
                                                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                                                <li>
                                                                                    <input type="submit" class="btn btn-lg btn-primary" placeholder="Update Profile" >
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- .tab-pane -->
                                                            </div><!-- .tab-content -->
                                                        </form>
                                                    </div><!-- .modal-body -->
                                                </div><!-- .modal-content -->
                                            </div><!-- .modal-dialog -->
                                        </div><!-- .modal -->
                                    @empty
                                    @endforelse

                                    <div class="modal fade" tabindex="-1" role="dialog" id="update">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                                <div class="modal-body modal-body-lg">
                                                    <h5 class="title">Add Message</h5>
                                                    <ul class="nk-nav nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#personal">Informations</a>
                                                        </li>
                                                    </ul><!-- .nav-tabs -->
                                                    <form action="{{route('messages.store')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="personal">
                                                                <div class="row gy-4">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="prenom">Prénom</label>
                                                                            <input type="text" class="form-control form-control-lg"
                                                                                   name="prenom" required
                                                                                   placeholder="Enter name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="nom">Nom de famille</label>
                                                                            <input type="text" class="form-control form-control-lg"
                                                                                   name="nom" required
                                                                                   placeholder="Enter display name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="email">Titre de l'Auteur</label>
                                                                            <input type="text" class="form-control form-control-lg"
                                                                                   name="titreAuteur" required
                                                                                   placeholder="Titre here">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="phone">Date</label>
                                                                            <input type="datetime-local" class="form-control form-control-xl form-control-outlined"
                                                                                   name="date" required
                                                                                   placeholder="Date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="phone">Titre Message</label>
                                                                            <input type="text" class="form-control form-control-lg"
                                                                                   name="titreMessage" required
                                                                                   placeholder="Titre Message">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="phone">Introduction</label>
                                                                            <input type="text" class="form-control form-control-lg"
                                                                                   name="introduction" required
                                                                                   placeholder="Introduction here">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="default-textarea">Bio</label>
                                                                            <div class="form-control-wrap">
                                                                                    <textarea class="form-control no-resize"
                                                                                              name="about" required>
                                                                                    </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="default-textarea">Corps du Message</label>
                                                                            <div class="form-control-wrap">
                                                                                    <textarea class="form-control no-resize"
                                                                                              name="message" required>
                                                                                    </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="default-06">Photos</label>
                                                                            <div class="form-control-wrap">
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                           multiple class="custom-file-input"
                                                                                           accept="image/png, image/jpeg"
                                                                                           name="file" required>
                                                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                                            <li>
                                                                                <input type="submit" class="btn btn-lg btn-primary" placeholder="Update Profile" >
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .tab-pane -->
                                                        </div><!-- .tab-content -->
                                                    </form>
                                                </div><!-- .modal-body -->
                                            </div><!-- .modal-content -->
                                        </div><!-- .modal-dialog -->
                                    </div><!-- .modal -->

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection

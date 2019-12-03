@extends('layouts.master')
@section('content')
    @if (Request::is('ajoutVisiteur'))
        {!! Form::open(['url' => 'addVisitor']) !!}
        <div class="col-md-12 col-sm-12 well well-md">
            <h1>Inscrire un nouveau visiteur</h1>
            <br>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Nom :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Prénom :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="firstName" id="firstName" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">email :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="mail" id="mail" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Numéro téléphone :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="tel" id="tel" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Adresse :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Code Postal :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="cp" id="cp" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Ville :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="ville" id="ville" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = '{{ url('/saisirFraisForfait')}}';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    @elseif (Request::is('modifierCompte'))
        {!! Form::open(['url' => '']) !!}
        <div class="col-md-12 col-sm-12 well well-md">
            <h1>Modifier mes informations</h1>
            <br>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Nom :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Prénom :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="firstName" id="firstName" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">email :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="mail" id="mail" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Numéro téléphone :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="tel" id="tel" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Adresse :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Code Postal :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="cp" id="cp" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Ville :</label>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="ville" id="ville" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    @else
        <h3>ERREUR 404 : La page que vous demander n'existe pas !!</h3>
    @endif
@stop







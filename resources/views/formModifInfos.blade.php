@extends('layouts.master')
@section('content')

<div class="col-md-12 well well-md modifInfosMdp">
    <div class="infosPerso">
        {!! Form::open(['url' => 'modifInfos']) !!} 
        <h2>Modifier mes informations personnelles</h2>
        <div class="form-horizontal">    
            <div class="form-group">
                <label class="col-md-3 control-label">adresse : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" name="adresse" ng-model="adresse" class="form-control" placeholder="Votre adresse" maxlength ="30"  value="{{ isset($errors) && count($errors) > 0 ? old('adresse'): $info->adresse }}" required pattern="[0-9]{1,3}\s[a-z\séèàêâùïüëA-Z-']{1,29}"> 
                    @if($errors->has('adresse'))
                    <div class="alert alert-danger">
                        {{ $errors->first('adresse') }}
                    </div>
                    @endif
                    </div> 
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">code postal : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" name="cp" ng-model="cp" class="form-control" placeholder="Votre code postal" size ="5"  value="{{ isset($errors) && count($errors) > 0 ? old('cp'): $info->cp }}" pattern="[0-9]{5}" required> 
                    @if($errors->has('cp'))
                    <div class="alert alert-danger">
                        {{ $errors->first('cp') }}
                    </div>
                    @endif
                    </div> 
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">ville : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" name="ville" ng-model="ville" class="form-control" placeholder="Votre ville" maxlength="30" pattern ="^[a-zéèàêâùïüëA-Z][a-zéèàêâùïüëA-Z-'\s]{1,30}$" value="{{isset($errors) && count($errors) > 0 ? old('ville'): $info->ville}}" required>
                    @if($errors->has('ville'))
                    <div class="alert alert-danger">
                        {{ $errors->first('ville') }}
                    </div>
                    @endif
                </div>  
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">téléphone : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" name="tel" ng-model="tel" class="form-control" placeholder="Votre téléphone" pattern ="[0-9]{3,15}" value="{{isset($errors) && count($errors) > 0 ? old('tel'): $info->tel}}" required>
                    @if($errors->has('tel'))
                    <div class="alert alert-danger">
                        {{ $errors->first('tel') }}
                    </div>
                    @endif
                </div>  
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">email : </label>
                <div class="col-md-6 col-md-3">
                    <input type="email" name="email" ng-model="email" class="form-control" placeholder="Votre email" value="{{isset($errors) && count($errors) > 0 ? old('email'): $info->email}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    @if($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>  
            </div>        
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-log-in"></span> Valider
                    </button>
                </div>
            </div>
    @if (session('erreur'))
            <div class="alert alert-danger">
            {{ session('erreur') }}
            </div>
    @endif
        </div>
        {!! Form::close() !!}
    </div>

    <div class="modifMdp">
        {!! Form::open(['url' => 'modifMdp']) !!} 
        <h2>Modifier mon mot de passe</h2>
        
        <div class="form-horizontal">    
            
            <div class="form-group">
                <label class="col-md-3 control-label">mot de passe actuel : </label>
                <div class="col-md-6 col-md-3">
                    <input type="password" name="mdpActuel" ng-model="mdpActuel" class="form-control" placeholder="Votre mot de passe actuel" required> 
                    @if($errors->has('mdpActuel'))
                    <div class="alert alert-danger">
                        {{ $errors->first('mdpActuel') }}
                    </div>
                    @endif
                    </div> 
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">nouveau mot de passe : </label>
                <div class="col-md-6 col-md-3">
                    <input type="password" name="nvMdp" ng-model="nvMdp" class="form-control" placeholder="Votre nouveau mot de passe" required>
                    @if($errors->has('nvMdp'))
                    <div class="alert alert-danger">
                        {{ $errors->first('nvMdp') }}
                    </div>
                    @endif
                </div>  
            </div>   
            <div class="form-group">
                <label class="col-md-3 control-label">confirmation mot de passe : </label>
                <div class="col-md-6 col-md-3">
                    <input type="password" name="confirmMdp" ng-model="confirmMdp" class="form-control" placeholder="Confirmer votre mot de passe" required>
                    @if($errors->has('confirmMdp'))
                    <div class="alert alert-danger">
                        {{ $errors->first('confirmMdp') }}
                    </div>
                    @endif
                </div>  
            </div>   
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-log-in"></span> Valider
                    </button>
                </div>
            </div>
    @if (session('erreur'))
            <div class="alert alert-danger">
            {{ session('erreur') }}
            </div>
    @endif
        </div>
        {!! Form::close() !!}
    </div>
    
</div>
@stop


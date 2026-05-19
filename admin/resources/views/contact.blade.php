@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Contactez-moi</div>

            <div class="panel-body">

                <form method="POST" action="{{ url('contact') }}">
                    @csrf

                    <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
                        <input 
                            type="text" 
                            name="nom" 
                            class="form-control" 
                            placeholder="Votre nom"
                            value="{{ old('nom') }}"
                        >
                        @error('nom')<small class="help-block">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="Votre email"
                            value="{{ old('email') }}"
                        >

                        @error('email')<small class="help-block">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group {{ $errors->has('texte') ? 'has-error' : '' }}">
                        <textarea 
                            name="texte" 
                            class="form-control" 
                            placeholder="Votre message"
                        >{{ old('texte') }}</textarea>

                        @error('texte')<small class="help-block">{{ $message }}</small>@enderror
                    </div>

                    <button type="submit" class="btn btn-info pull-right">Envoyer !</button>
                </form>

            </div>
        </div>
    </div>
@stop
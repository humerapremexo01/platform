<div class="form-group{{ $errors->has($oldName) ? ' has-error' : '' }}">
    @if(isset($title))
        <label for="{{$id}}">{{$title}}</label>
    @endif
    <select @include('dashboard::partials.fields.attributes', ['attributes' => $attributes])>
        <option value="index">Index</option>
        <option value="noindex">Noindex</option>
    </select>
    @if(isset($help))
        <p class="help-block">{{$help}}</p>
    @endif
</div>
@include('dashboard::partials.fields.hr', ['show' => $hr ?? true])

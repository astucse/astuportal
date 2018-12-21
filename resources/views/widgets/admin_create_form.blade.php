<div class="nav-tabs-custom">
	<ul class="nav nav-tabs pull-right">
		<li class="pull-left header"><i class="fa fa-th"></i>Create {{$config['name']}}</b></li>
	</ul>
	<div class="tab-content">
		<div class="row">
			<form action="{{$config['action']}}" method="POST">
				{{ csrf_field() }}
				@foreach($fields as $field)
				<div class="col-xs-12">
					<div class="form-group">
						<label>{{$field->label}}</label>
						@if($field->category == "input")
							<input name="{{$field->name}}" type="{{$field->type}}" class="form-control" placeholder="{{$field->placeholder}}" <?php if(isset($field->disabled)) echo "disabled"; ?> >
						@elseif($field->category == "textarea")
							<textarea name="{{$field->name}}" cols="{{$field->cols}}" rows="{{$field->rows}}" class="form-control">{{$field->placeholder}}</textarea>
						@elseif($field->category == "select")
							<select name="{{$field->name}}" class="form-control">
								@foreach($field->children as $child)
								<option value="{{$child->value}}">{{$child->name}}</option>
								@endforeach
							</select> 
						@endif
					</div>
				</div>
				@endforeach
<!-- 				<div class="col-xs-12">
					<div class="form-group">
						<label>Target</label>
						<select name="target" class="form-control">
							<option value="student">student</option>
							<option value="collegue">collegue</option>
							<option value="head">head</option>
						</select>
					</div>
				</div> -->
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>

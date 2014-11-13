<div id="modalnamechange" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Edit Name
				</h3>
			</div>
			@if(empty($user))
				<div class="modal-body" style="max-height: 75%">
					<div class="alert alert-warning">
						User information failed to load!
					</div>
				</div>
			@else
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::model($user,array('method'=>'put', 'action'=>array('GenerateTeams@changeName',$user)))}}
					<div class="form-group">
						{{ Form::label('First name',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('firstname', $user->firstname ,array("class"=>"form-control"))}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Last name',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('lastname', $user->lastname ,array("class"=>"form-control")) }}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="max-height: 25%">
				<div class="text-center">
					{{ Form::submit('Save',array("class"=>"btn btn-primary text-center")) }}
				</div>
				{{ Form::close() }}
			</div>
			@endif
		</div>
	</div>
</div>
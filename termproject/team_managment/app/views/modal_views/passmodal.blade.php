<div id="modalpasschange"class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Change password
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
				<div class="content form-horizontal" >
					{{ Form::model($user,array('method'=>'put', 'action'=>array('GenerateTeams@changePassword'))) }}
					{{ Form::hidden('userid',$user->id) }}
					
					<div class="form-group">
						{{ Form::label('Old password',null,array("class"=>"control-label col-sm-3"))}}
						<div class="col-sm-6">
							{{ Form::password('password',array("class"=>"form-control", 0=>'required'))}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('New password',null,array("class"=>"control-label col-sm-3"))}}
						<div class="col-sm-6">
							{{ Form::password('newpassword',array("class"=>"form-control", 0=>'required'))}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Confirm password',null,array("class"=>"control-label col-sm-3"))}}
						<div class="col-sm-6">
							{{ Form::password('confirmpassword',array("class"=>"form-control", 0=>'required')) }}
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
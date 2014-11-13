<div id="modalprojchange" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Edit Project Preferences
				</h3>
			</div>
			@if(empty($user) || empty($projoptions))
				<div class="modal-body" style="max-height: 75%">
					<div class="alert alert-warning">
						User information failed to load!
					</div>
				</div>
			@else
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::model($user,array('method'=>'put', 'action'=>array('GenerateTeams@changeProjPref',$user)))}}
					<div class="form-group">
						{{ Form::label('1<sup>st</sup> choice',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('first_project_id', $projoptions,$user->projectpreference()->first_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('2<sup>nd</sup> choice',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('second_project_id', $projoptions,$user->projectpreference()->second_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('3<sup>rd</sup> choice',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('third_project_id', $projoptions,$user->projectpreference()->third_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
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
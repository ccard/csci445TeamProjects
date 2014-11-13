<div id="modalprojchange" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Edit Project Preferences
				</h3>
			</div>
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::model($user,array('method'=>'put', 'action'=>array('GenerateTeams@changeProjPref',$user)))}}
					<div class="form-group">
						{{ Form::label('1st choice',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('first_proj_id', $projoptions,1,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('2nd choice',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('second_proj_id', $projoptions,1,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('3rd choice',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('third_proj_id', $projoptions,2,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
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
		</div>
	</div>
</div>
<div id="modaldegchange" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Edit Major/Minor
				</h3>
			</div>
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::model($user,array('method'=>'put', 'action'=>array('GenerateTeams@changeMajor',$user)))}}
					<div class="form-group">
						{{ Form::label('Major',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('majortext', 'major' ,array("class"=>"form-control"))}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Minor/ASI',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('minortext', 'minor' ,array("class"=>"form-control")) }}
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
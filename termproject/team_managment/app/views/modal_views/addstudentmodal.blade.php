<div id="modaladdstudent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Add student
				</h3>
			</div>
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::open(array('method'=>'post', 'url'=>'home/accountinfo/managestudents/newstudent')) }}
					<div class="form-group">
						{{ Form::label('First Name',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('firstname',null,array("class"=>"form-control",0=>'required'))}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Last Name',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('lastname', null ,array("class"=>"form-control",0=>'required')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Email',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('username', null ,array("class"=>"form-control",0=>'required')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('CWID',null,array("class"=>"control-label col-sm-3")) }}
						<div class="col-sm-7">
							{{ Form::text('cwid', null ,array("class"=>"form-control",0=>'required')) }}
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
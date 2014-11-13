<div id="modaladminadduser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Add new team member
				</h3>
			</div>
			@if(empty($nonassignusers) || empty($projid))
				<div class="modal-body" style="max-height: 75%">
					<div class="alert alert-warning">
						There are no unassigned users
					</div>
				</div>
			@else
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::open(array('method'=>'put', 'action'=>array('GenerateTeams@adminAddMember')))}}
					{{ Form::hidden('projid',$projid) }}
					<div class="form-group">
						{{ Form::label('User',null,array("class"=>"col-sm-2 control-label")) }}
						<div class="col-sm-10">
							{{ Form::select('user_id', $nonassignusers,null,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
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
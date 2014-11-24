<div id="modalpartchange" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="reset" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				Edit Partner Preferences
				</h3>
			</div>
			@if(empty($user) || empty($partneroptions) || empty($perferedchoice) || empty($avoidchoice))
				<div class="modal-body" style="max-height: 75%">
					<div class="alert alert-warning">
						User information failed to load!
					</div>
				</div>
			@else
			<div class="modal-body" style="max-height: 75%">
				<div class="content form-horizontal">
					{{ Form::model($user,array('method'=>'put', 'url'=>'home/accountinfo/partprefchange'))}}
					{{ Form::hidden('userid',$user->id) }}
					<div class="row">
						<div class="form-group col-lg-6">
							{{ Form::label('Prefered Partners',null,array("class"=>"col-lg-2 control-label")) }}
							<div class="col-lg-10">
								{{ Form::select('pref_partner[]', $partneroptions,$perferedchoice,array('multiple'=>'multiple',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'Hold ctrl to select more than one person','autocomplete'=>"off")) }}
							</div>
						</div>
						<div class="form-group col-lg-6">
							{{ Form::label('Dont want to work with',null,array("class"=>"col-lg-2 control-label")) }}
							<div class="col-lg-10">
								{{ Form::select('no_pref_partner[]', $partneroptions,$avoidchoice,array('multiple'=>'multiple',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'Hold ctrl to select more than one person','autocomplete'=>"off")) }}
							</div>
						</div>
						<div class="text-center row">
							<div class="form-group checkbox-inline">
								{{ Form::radio('pref_part_or_proj','1',($user->pref_part_or_proj == 1 ? true : null),array('autocomplete'=>"off")) }}
								{{ Form::label('partner','Prefer Partners',array("class"=>"control-label", "style"=>"margin-right: 15px")) }}
							</div>
							<div class="form-group checkbox-inline">
								{{ Form::radio('pref_part_or_proj', '0', ($user->pref_part_or_proj == 0 ? true : null),array('autocomplete'=>"off")) }}
								{{ Form::label('project','Prefer Project',array("class"=>"control-label")) }}
							</div>
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
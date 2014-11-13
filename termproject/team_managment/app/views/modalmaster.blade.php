<div id=@yield('dialogid') class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="max-height: 65%; max-width: 100%; width: 35%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<h3>
				<button type="button" id="modal-cancel" class="btn btn-link close pull-right" data-dismiss="modal" aria-hidden="true">Cancel</button>
				@yield('modalHead')
				</h3>
			</div>
			<div class="modal-body" style="max-height: 75%">
				@yield('modalcontent')
			</div>
			<div class="modal-footer" style="max-height: 25%">
				@yield('modalfoot')
			</div>
		</div>
	</div>
</div>
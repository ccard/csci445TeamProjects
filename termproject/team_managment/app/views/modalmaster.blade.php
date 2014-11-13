<div id=@yield('dialogid') class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="top:5%; bottom:5%;">
	<div class="modal-dialog" style="max-height: 100%; height: 65%;">
		<div class="modal-content" style="height: 100%">
			<div class="modal-header">
				<button type="button" id="modal-cancel" class="btn btn-link close" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<h3>
				@yield('modalHead')
				</h3>
			</div>
			<div class="modal-body" style="height: 75%">
				@yield('modalcontent')
			</div>
			<div class="modal-footer" style="height: 25%">
				@yield('modalfoot')
			</div>
		</div>
	</div>
</div>
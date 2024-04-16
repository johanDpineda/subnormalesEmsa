<!-- Modal para mostrar el PDF -->
<div  wire:ignore.self class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Documento Acuerdo Emsa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
        </div>
        <div class="modal-body">
          <embed id="pdfEmbed" src="" type="application/pdf" class="modomovilresoluciones" style="width: 100%;height: 600px;">
        </div>
      </div>
    </div>
  </div>

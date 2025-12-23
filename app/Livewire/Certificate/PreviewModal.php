<?php
namespace App\Livewire\Certificate;

use Livewire\Component;
use App\Models\Certificate;
use Illuminate\Support\Facades\Gate;

class PreviewModal extends Component
{
    public ?int $certificateId = null;
    public bool $show = false;
    public ?string $iframeSrc = null;
    public bool $loading = true;

    protected $listeners = [
        'openCertificatePreview' => 'open',
    ];

    public function open($id)
    {
        // find certificate
        $cert = Certificate::with(['student','trainer','course'])->find($id);
        if (! $cert) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Certificate not found','ttl'=>4000]);
            return;
        }

        // authorization via policy
        if (! auth()->check() || Gate::denies('view', $cert)) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Forbidden','message'=>'You are not allowed to view this certificate','ttl'=>5000]);
            return;
        }

        $this->certificateId = $id;
        $this->iframeSrc = route('certificates.pdf.preview', $id);
        $this->loading = true;
        $this->show = true;

        // optional small delay to ensure iframe src set before browser tries to load
        $this->dispatchBrowserEvent('certificate:open', ['id' => $id]);
    }

    public function close()
    {
        $this->show = false;
        // clear iframe to stop PDF streaming
        $this->iframeSrc = null;
        $this->certificateId = null;
        $this->loading = true;
    }

    // called from JS when iframe load completes
    public function iframeLoaded()
    {
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.certificate.preview-modal');
    }
}

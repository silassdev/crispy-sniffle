<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CertificateTemplate;

class CertificateTemplates extends Component
{
    use WithFileUploads;

    public $templates;
    public $name;
    public $image;
    public $layoutConfig = []; 

    protected $rules = [
        'name' => 'required|string|max:255',
        'image' => 'required|image|max:2048', 
    ];

    public function mount()
    {
        $this->loadTemplates();
    }

    public function loadTemplates()
    {
        $this->templates = CertificateTemplate::latest()->get();
    }

    public function save()
    {
        $this->validate();

        $path = $this->image->store('certificate-templates', 'public');

        CertificateTemplate::create([
            'name' => $this->name,
            'background_image_path' => $path,
            'layout_config' => $this->layoutConfig,
            'is_active' => true,
        ]);

        $this->reset(['name', 'image']);
        $this->loadTemplates();
        $this->dispatch('app-toast', ['title'=>'Success', 'message'=>'Template uploaded successfully']);
    }

    public function delete($id)
    {
        $template = CertificateTemplate::find($id);
        if ($template) {
            // Delete file logic if needed
            $template->delete();
            $this->loadTemplates();
            $this->dispatch('app-toast', ['title'=>'Deleted', 'message'=>'Template deleted']);
        }
    }

    public function toggleActive($id)
    {
        $template = CertificateTemplate::find($id);
        if ($template) {
            $template->is_active = !$template->is_active;
            $template->save();
            $this->loadTemplates();
        }
    }

    public function render()
    {
        return view('livewire.admin.certificate-templates');
    }
}

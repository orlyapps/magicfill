<?php

namespace App\Http\Livewire;

use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;

class MagicWand extends Component
{
    use WithFileUploads;

    public $photo;
    public $resizedPhoto = null;
    public $resultPhoto = null;
    public $tolerance = 17;
    public $x = null;
    public $y = null;

    public function mount()
    {
        $this->resizedPhoto = 'storage/sample.jpeg';
    }

    public function save()
    {
        $filename = \Str::uuid() . '.jpg';

        ImageManagerStatic::make(storage_path('app/' . $this->photo->store('public')))
            ->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(storage_path('app/public/' . $filename), 80, 'jpeg');

        $this->resizedPhoto = 'storage/' . $filename;
    }

    public function magicwand($x, $y)
    {
        $this->x = round($x * 2);
        $this->y = round($y * 2);
        $resultPhoto = \Str::uuid() . '.jpg';
        $binary = base_path('magicwand');
        $output = storage_path('app/public/' . $resultPhoto);
        $input = storage_path('app/public/' . basename($this->resizedPhoto));
        $command = "{$binary} {$this->x},{$this->y} -t {$this->tolerance} -f image -r outside -m layer -c black -o 50 {$input} {$output}";
        exec($command);

        $this->resultPhoto = 'storage/' . $resultPhoto;
    }

    public function render()
    {
        return view('livewire.magic-wand');
    }
}

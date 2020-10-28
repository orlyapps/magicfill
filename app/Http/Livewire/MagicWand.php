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
        $this->resizedPhoto = null;
    }

    public function save()
    {
        $path = $this->photo->store('photos');
        $filepath = storage_path('app/' . $path);
        $this->resizedPhoto = \Str::uuid() . '.jpg';
        ImageManagerStatic::make($filepath)
            ->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(storage_path('app/public/' . $this->resizedPhoto), 80, 'jpeg');
    }

    public function magicwand($x, $y)
    {
        $this->x = round($x * 2);
        $this->y = round($y * 2);
        $this->resultPhoto = \Str::uuid() . '.jpg';
        $resultPath = storage_path('app/public/' . $this->resultPhoto);
        $binary = base_path('magicwand');
        $input = storage_path('app/public/' . $this->resizedPhoto);
        $command = "{$binary} {$this->x},{$this->y} -t {$this->tolerance} -f image -r outside -m layer -c black -o 50 {$input} {$resultPath}";

        exec($command);
    }

    public function render()
    {
        return view('livewire.magic-wand');
    }
}

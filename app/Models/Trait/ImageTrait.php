<?php

namespace App\Models\Trait;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Features;

trait ImageTrait
{
    public function updateImage(UploadedFile $photo, $storagePath = 'profile-photos', $fieldName = 'image'): void
    {
        tap($this->{$fieldName}, function ($previous) use ($photo, $storagePath, $fieldName) {
            $this->forceFill([
                $fieldName => $photo->storePublicly(
                    $storagePath,
                    ['disk' => 'public']
                ),
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }

    public function deleteImage($fieldName = 'image'): void
    {
        if (is_null($this->{$fieldName})) {
            return;
        }

        Storage::disk('public')->delete($this->{$fieldName});

        $this->forceFill([
            $fieldName => null,
        ])->save();
    }
}

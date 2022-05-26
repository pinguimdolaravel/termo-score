<?php

namespace App\Http\Controllers;

class TioJobsController extends Controller
{
    public function __invoke()
    {
        $this->authorize('tio-jobs');

        request()->validate([
            'name' => ['required'],
        ]);

		// facooac

        return ['Tio Jobs'];
    }
}

<x-filament::page>
    <x-filament::card>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold tracking-tight">Add Student Marks</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Form Selection -->
            <div>
                <label class="filament-forms-field-wrapper-label inline-flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium leading-4" for="form-select">
                    <span>Select Form</span>
                    <span class="text-danger-500">*</span>
                </label>
                
                <div class="filament-forms-select-component flex items-center space-x-1 rtl:space-x-reverse group">
                    <select
                        id="form-select"
                        wire:model.live="selectedForm"
                        class="block w-full h-10 transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                        <option value="">Choose Form</option>
                        @foreach(\App\Models\Form::with('stream')->get() as $form)
                            <option value="{{ $form->id }}">
                                {{ $form->year }} {{ $form->stream->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                @error('selectedForm') 
                    <p class="filament-forms-field-wrapper-error-message text-sm text-danger-600 dark:text-danger-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Subject Selection -->
            <div>
                <label class="filament-forms-field-wrapper-label inline-flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium leading-4" for="subject-select">
                    <span>Select Subject</span>
                    <span class="text-danger-500">*</span>
                </label>
                
                <div class="filament-forms-select-component flex items-center space-x-1 rtl:space-x-reverse group">
                    <select
                        id="subject-select"
                        wire:model.live="selectedSubject"
                        class="block w-full h-10 transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                        <option value="">Choose Subject</option>
                        @foreach(\App\Models\Subject::all() as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                @error('selectedSubject') 
                    <p class="filament-forms-field-wrapper-error-message text-sm text-danger-600 dark:text-danger-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
    </x-filament::card>

    <!-- Display Student Marks Form -->
    @if(!empty($students) && is_object($students) && $students->count() > 0)
        <x-filament::card class="mt-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold tracking-tight">Enter Marks for Students</h2>
            </div>
            
            <form wire:submit="saveMarks">
                <div class="filament-tables-container rounded-xl border border-gray-300 dark:border-gray-700 overflow-hidden">
                    <table class="filament-tables-table w-full text-start divide-y table-auto dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-500/5 dark:bg-gray-700">
                                <th class="px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-600 dark:text-gray-300">
                                    Student Name
                                </th>
                                <th class="px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-600 dark:text-gray-300">
                                    Marks (out of 100)
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($students as $student)
                                <tr wire:key="{{ $student->id }}" class="filament-tables-row transition hover:bg-gray-50 dark:hover:bg-gray-500/10">
                                    <td class="px-4 py-2 align-middle text-sm">
                                        {{ $student->first_name }} {{ $student->last_name ?? '' }}
                                    </td>
                                    <td class="px-4 py-2 align-middle text-sm">
                                        <div>
                                            <input 
                                                type="number" 
                                                wire:model="marks_obtained.{{ $student->id }}" 
                                                min="0" 
                                                max="100"
                                                class="block w-full h-10 transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                            >
                                            @error('marks_obtained.'.$student->id) 
                                                <p class="text-sm text-danger-600 dark:text-danger-500 mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-end">
                    <button 
                        type="submit" 
                        class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:bg-primary-700 dark:focus:ring-offset-primary-700"
                    >
                        Save Marks
                    </button>
                </div>
            </form>
        </x-filament::card>
    @elseif(is_array($students) && count($students) > 0)
        <x-filament::card class="mt-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold tracking-tight">Enter Marks for Students</h2>
            </div>
            
            <form wire:submit="saveMarks">
                <div class="filament-tables-container rounded-xl border border-gray-300 dark:border-gray-700 overflow-hidden">
                    <table class="filament-tables-table w-full text-start divide-y table-auto dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-500/5 dark:bg-gray-700">
                                <th class="px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-600 dark:text-gray-300">
                                    Student Name
                                </th>
                                <th class="px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-600 dark:text-gray-300">
                                    Marks (out of 100)
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($students as $student)
                                <tr wire:key="{{ $student->id }}" class="filament-tables-row transition hover:bg-gray-50 dark:hover:bg-gray-500/10">
                                    <td class="px-4 py-2 align-middle text-sm">
                                        {{ $student->first_name }} {{ $student->last_name ?? '' }}
                                    </td>
                                    <td class="px-4 py-2 align-middle text-sm">
                                        <div>
                                            <input 
                                                type="number" 
                                                wire:model="marks_obtained.{{ $student->id }}" 
                                                min="0" 
                                                max="100"
                                                class="block w-full h-10 transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                            >
                                            @error('marks_obtained.'.$student->id) 
                                                <p class="text-sm text-danger-600 dark:text-danger-500 mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-end">
                    <button 
                        type="submit" 
                        class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:bg-primary-700 dark:focus:ring-offset-primary-700"
                    >
                        Save Marks
                    </button>
                </div>
            </form>
        </x-filament::card>
    @elseif($selectedForm && $selectedSubject)
        <div class="filament-tables-empty-state flex flex-1 flex-col items-center justify-center p-6 mx-auto space-y-6 text-center bg-white rounded-lg shadow dark:bg-gray-800 mt-6">
            <div class="flex items-center justify-center w-16 h-16 rounded-full text-warning-500 bg-warning-50 dark:bg-warning-500/20">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            
            <div class="max-w-md space-y-1">
                <h2 class="text-lg font-medium tracking-tight dark:text-white">
                    No students found
                </h2>
                
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    No students found in this form. Please select a different form.
                </p>
            </div>
        </div>
    @endif
</x-filament::page>
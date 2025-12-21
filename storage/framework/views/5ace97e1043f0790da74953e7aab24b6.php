<div class="space-y-8 animate-in fade-in duration-500">
    
    <div class="relative overflow-hidden rounded-3xl bg-slate-900 p-8 text-white shadow-2xl">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Course Manager</h1>
                <p class="mt-2 text-slate-400 max-w-md">Design, manage, and publish your educational content with ease.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-500 group-focus-within:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" 
                        type="text" 
                        placeholder="Search courses..." 
                        class="block w-full pl-10 pr-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all sm:text-sm"
                    />
                </div>
                <button wire:click="create" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Course
                </button>
            </div>
        </div>
        
        <div class="absolute -top-24 -right-24 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-purple-500/10 blur-3xl"></div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="group relative bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 flex flex-col">
                
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <!--[if BLOCK]><![endif]--><?php if($c->hasMedia('illustration')): ?>
                        <img src="<?php echo e($c->getFirstMediaUrl('illustration')); ?>" alt="<?php echo e($c->title); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    
                    
                    <div class="absolute top-4 right-4 flex gap-2">
                        <!--[if BLOCK]><![endif]--><?php if($c->is_public): ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100/90 text-emerald-700 backdrop-blur-sm">
                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-500"></span>
                                Public
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100/90 text-amber-700 backdrop-blur-sm">
                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-500"></span>
                                Private
                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex-1">
                        <div class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">ID: <?php echo e($c->course_id); ?></div>
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-1 mb-2">
                            <?php echo e($c->title); ?>

                        </h3>
                        <p class="text-slate-500 text-sm line-clamp-2 mb-4">
                            <?php echo e($c->excerpt ?? 'No description provided.'); ?>

                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                        <div class="flex items-center text-slate-600 font-medium">
                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="text-sm"><?php echo e($c->enrollments()->count()); ?> Students</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <a href="<?php echo e(route('trainer.courses.show', $c->id)); ?>" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="View Details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <button wire:click="edit(<?php echo e($c->id); ?>)" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all" title="Edit Course">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button wire:click="delete(<?php echo e($c->id); ?>)" 
                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all" title="Delete Course">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full flex flex-col items-center justify-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                <div class="p-4 bg-slate-50 rounded-full mb-4">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900">No courses found</h3>
                <p class="text-slate-500 mb-6">Start by creating your first course to share your knowledge.</p>
                <button wire:click="create" class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-colors">
                    Create Course
                </button>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div class="py-6">
        <?php echo e($courses->links()); ?>

    </div>

    
    <!--[if BLOCK]><![endif]--><?php if($showForm): ?>
        <div class="fixed inset-0 z-[60] flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
            
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="resetForm"></div>

            
            <div class="relative w-full max-w-4xl mx-auto my-6 px-4 z-10 animate-in fade-in zoom-in duration-300">
                <div class="relative bg-white rounded-[2.5rem] shadow-2xl flex flex-col w-full outline-none focus:outline-none overflow-hidden">
                    
                    <div class="flex items-center justify-between p-8 border-b border-slate-100">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900"><?php echo e($courseId ? 'Edit Course' : 'Create New Course'); ?></h3>
                            <p class="text-sm text-slate-500 mt-1">Fill in the details below to <?php echo e($courseId ? 'update your' : 'setup your new'); ?> course.</p>
                        </div>
                        <button wire:click="resetForm" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    
                    <div class="relative p-8 flex-auto max-h-[70vh] overflow-y-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Course Title</label>
                                    <input wire:model.defer="title" type="text" placeholder="e.g. Advanced Laravel Development" 
                                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" />
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-medium"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Short Excerpt</label>
                                    <input wire:model.defer="excerpt" type="text" placeholder="Brief summary for the course card" 
                                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" />
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['excerpt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-medium"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Markdown Content</label>
                                    <textarea wire:model.live.debounce.500ms="body" rows="10" placeholder="Supports full markdown. Describe your course in detail..." 
                                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-mono text-sm"></textarea>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-medium"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-2">Visibility</label>
                                        <select wire:model.defer="is_public" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                                            <option value="1">Public Access</option>
                                            <option value="0">Authenticated Only</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tags</label>
                                        <input wire:model.defer="tags" type="text" placeholder="laravel, php, oop" 
                                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" />
                                    </div>
                                </div>
                            </div>

                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">YouTube Video URL</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                        </div>
                                        <input wire:model.defer="youtube_url" type="text" placeholder="https://youtube.com/watch?v=..." 
                                            class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Zoom Meeting URL</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.585 10.32l1.678-4.508c.553-1.484 1.97-2.512 3.553-2.512h4.369c1.582 0 3 .1.28l3.553 2.512.678 4.508H4.585zm14.83 1.18c.28 0 .507.227.507.507v4.613c0 1.583-1.028 3-2.512 3.553l-4.508 1.678c-.28.104-.593.104-.873 0l-4.508-1.678c-1.484-.553-2.512-1.97-2.512-3.553v-4.613c0-.28.227-.507.507-.507h13.399zm-2.415 2.56h-2.144c-.28 0-.507.227-.507.507v2.09c0 .281.227.508.507.508h2.144c.281 0 .508-.227.508-.508v-2.09c0-.28-.227-.507-.508-.507z"/></svg>
                                        </div>
                                        <input wire:model.defer="zoom_url" type="text" placeholder="https://zoom.us/j/..." 
                                            class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Course Illustration</label>
                                    <div class="relative group cursor-pointer">
                                        <div class="w-full h-32 border-2 border-dashed border-slate-200 group-hover:border-indigo-500 rounded-2xl flex flex-col items-center justify-center transition-colors overflow-hidden relative">
                                            <!--[if BLOCK]><![endif]--><?php if($illustration): ?>
                                                <img src="<?php echo e($illustration->temporaryUrl()); ?>" class="absolute inset-0 w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <span class="text-white text-xs font-semibold">Replace Image</span>
                                                </div>
                                            <?php else: ?>
                                                <svg class="w-8 h-8 text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-xs text-slate-500">Upload JPG, PNG, WEBP</span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <input type="file" wire:model="illustration" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" />
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['illustration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-medium"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                        <div wire:loading wire:target="illustration" class="mt-2 text-xs text-indigo-600 animate-pulse">Uploading image...</div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Attachments (PDF)</label>
                                    <div class="w-full min-h-[80px] border border-slate-200 rounded-2xl p-4">
                                        <input type="file" wire:model="attachments" multiple accept="application/pdf" class="text-sm text-slate-500" />
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['attachments.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-medium"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                        <div wire:loading wire:target="attachments" class="mt-2 text-xs text-indigo-600 animate-pulse">Processing files...</div>
                                    </div>
                                </div>

                                
                                <div class="mt-4 p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Content Preview</h4>
                                    <div class="prose prose-sm max-w-none prose-slate h-[200px] overflow-y-auto">
                                        <!--[if BLOCK]><![endif]--><?php if($body): ?>
                                            <?php echo \Parsedown::instance()->text($body); ?>

                                        <?php else: ?>
                                            <p class="text-slate-400 italic">Preview will appear here as you type...</p>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex items-center justify-end p-8 border-t border-slate-100 gap-4">
                        <button wire:click="resetForm" class="px-8 py-3 text-slate-600 font-semibold hover:bg-slate-50 rounded-2xl transition-all">
                            Cancel
                        </button>
                        <button wire:click="save" 
                            class="relative px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 transition-all flex items-center justify-center">
                            <span wire:loading.remove wire:target="save">
                                <?php echo e($courseId ? 'Save Changes' : 'Create Course'); ?>

                            </span>
                            <span wire:loading wire:target="save" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/trainer/course-manager.blade.php ENDPATH**/ ?>
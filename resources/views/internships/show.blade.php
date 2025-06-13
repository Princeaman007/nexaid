@extends('layouts.app')

@section('content')
    <div class="internship-detail-container" style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: 'Helvetica Neue', Arial, sans-serif;">
        <!-- Breadcrumb navigation -->
        <div class="breadcrumb" style="margin-bottom: 20px;">
            <a href="{{ route('internships.index') }}" style="color: #6c757d; text-decoration: none; font-size: 0.9em;">
                <span style="margin-right: 5px;">&#8592;</span>
                Back to internship list
            </a>
        </div>

        <!-- Internship header section -->
        <div class="internship-header" style="margin-bottom: 30px;">
            <h1 style="margin-top: 0; color: #2c3e50; font-size: 2.2em; margin-bottom: 15px; font-weight: 600;">
                {{ $internship->location }} - {{ $internship->getTranslation('title', app()->getLocale(), false) }}
            </h1>
            
            <div class="internship-meta" style="display: flex; flex-wrap: wrap; margin-bottom: 20px; gap: 10px;">
                @if($internship->category)
                    <span style="background-color: #3498db; padding: 6px 12px; border-radius: 20px; font-size: 0.85em; color: white;">
                        {{ $internship->category->getTranslation('name', app()->getLocale(), false) }}
                    </span>
                @endif
                
                @if($internship->company_name)
                    <span style="background-color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 0.85em; color: white;">
                        {{ $internship->company_name }}
                    </span>
                @endif
                
                @if($internship->position_type)
                    <span style="background-color: #9b59b6; padding: 6px 12px; border-radius: 20px; font-size: 0.85em; color: white;">
                        {{ $internship->position_type }}
                    </span>
                @endif
                
                @if($internship->remote_option)
                    <span style="background-color: #e74c3c; padding: 6px 12px; border-radius: 20px; font-size: 0.85em; color: white;">
                        {{ $internship->remote_option }}
                    </span>
                @endif
                
                @if($internship->internship_level)
                    <span style="background-color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 0.85em; color: white;">
                        {{ ucfirst($internship->internship_level) }} Level
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Image + Apply Now sidebar -->
        <div class="internship-main-content" style="display: flex; flex-wrap: wrap; gap: 30px; margin-bottom: 40px;">
            <div class="internship-content" style="flex: 2; min-width: 300px;">
                <!-- Company description (if available) -->
                @if($internship->company_description)
                    <div class="company-description" style="margin-bottom: 25px; color: #444; line-height: 1.6; padding: 15px; background-color: #f8f9fa; border-radius: 8px;">
                        <h3 style="color: #2c3e50; font-size: 1.3em; margin-bottom: 10px;">About {{ $internship->company_name }}</h3>
                        {!! $internship->getTranslation('company_description', app()->getLocale(), false) !!}
                    </div>
                @endif
                
                <!-- Internship description -->
                <div class="description" style="margin-bottom: 30px; color: #444; line-height: 1.6;">
                    {!! $internship->getTranslation('description', app()->getLocale(), false) !!}
                </div>
                
                <!-- Main responsibilities section -->
                <div class="missions-section" style="margin-bottom: 30px;">
                    <h2 style="color: #2c3e50; font-size: 1.5em; padding-bottom: 10px; border-bottom: 2px solid #ecf0f1; margin-bottom: 15px;">
                        Main missions and responsibilities
                    </h2>
                    
                    @if($internship->main_responsibilities && is_array($internship->getTranslation('main_responsibilities', app()->getLocale(), false)))
                        <ul style="padding-left: 20px; list-style-type: disc; color: #444; line-height: 1.6;">
                            @foreach($internship->getTranslation('main_responsibilities', app()->getLocale(), false) as $responsibility)
                                @if(isset($responsibility['responsibility']))
                                    <li style="margin-bottom: 8px;">{{ $responsibility['responsibility'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @elseif($internship->learning_outcomes && is_array($internship->getTranslation('learning_outcomes', app()->getLocale(), false)))
                        <ul style="padding-left: 20px; list-style-type: disc; color: #444; line-height: 1.6;">
                            @foreach($internship->getTranslation('learning_outcomes', app()->getLocale(), false) as $outcome)
                                @if(isset($outcome['outcome']))
                                    <li style="margin-bottom: 8px;">{{ $outcome['outcome'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
                
                <!-- What you'll learn section (if both main_responsibilities and learning_outcomes exist) -->
                @if($internship->main_responsibilities && $internship->learning_outcomes && 
                    is_array($internship->getTranslation('learning_outcomes', app()->getLocale(), false)))
                    <div class="learning-section" style="margin-bottom: 30px;">
                        <h2 style="color: #2c3e50; font-size: 1.5em; padding-bottom: 10px; border-bottom: 2px solid #ecf0f1; margin-bottom: 15px;">
                            What you'll learn
                        </h2>
                        
                        <ul style="padding-left: 20px; list-style-type: disc; color: #444; line-height: 1.6;">
                            @foreach($internship->getTranslation('learning_outcomes', app()->getLocale(), false) as $outcome)
                                @if(isset($outcome['outcome']))
                                    <li style="margin-bottom: 8px;">{{ $outcome['outcome'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Required skills section -->
                <div class="skills-section" style="margin-bottom: 30px;">
                    <h2 style="color: #2c3e50; font-size: 1.5em; padding-bottom: 10px; border-bottom: 2px solid #ecf0f1; margin-bottom: 15px;">
                        Skills
                    </h2>
                    
                    @if($internship->required_skills && is_array($internship->getTranslation('required_skills', app()->getLocale(), false)))
                        <ul style="padding-left: 20px; list-style-type: disc; color: #444; line-height: 1.6;">
                            @foreach($internship->getTranslation('required_skills', app()->getLocale(), false) as $skill)
                                @if(isset($skill['skill']))
                                    <li style="margin-bottom: 8px;">{{ $skill['skill'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    
                    @if($internship->qualifications && is_array($internship->getTranslation('qualifications', app()->getLocale(), false)))
                        <h3 style="color: #2c3e50; font-size: 1.2em; margin: 15px 0 10px 0;">Qualifications</h3>
                        <ul style="padding-left: 20px; list-style-type: disc; color: #444; line-height: 1.6;">
                            @foreach($internship->getTranslation('qualifications', app()->getLocale(), false) as $qualification)
                                @if(isset($qualification['qualification']))
                                    <li style="margin-bottom: 8px;">{{ $qualification['qualification'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    
                    @if($internship->required_language)
                        <p style="margin-top: 15px; color: #444;">
                            <strong>Language requirements:</strong> {{ $internship->required_language }}
                        </p>
                    @endif
                </div>
                
                <!-- Benefits section -->
                @if($internship->benefits && is_array($internship->getTranslation('benefits', app()->getLocale(), false)))
                    <div class="benefits-section" style="margin-bottom: 30px;">
                        <h2 style="color: #2c3e50; font-size: 1.5em; padding-bottom: 10px; border-bottom: 2px solid #ecf0f1; margin-bottom: 15px;">
                            Benefits
                        </h2>
                        
                        <ul style="padding-left: 20px; list-style-type: disc; color: #444; line-height: 1.6;">
                            @foreach($internship->getTranslation('benefits', app()->getLocale(), false) as $benefit)
                                @if(isset($benefit['benefit']))
                                    <li style="margin-bottom: 8px;">{{ $benefit['benefit'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- <!-- Application process section (if available) -->
                @if($internship->application_process)
                    <div class="application-process" style="margin-bottom: 30px;">
                        <h2 style="color: #2c3e50; font-size: 1.5em; padding-bottom: 10px; border-bottom: 2px solid #ecf0f1; margin-bottom: 15px;">
                            Application Process
                        </h2>
                        
                        <div style="color: #444; line-height: 1.6;">
                            {!! $internship->getTranslation('application_process', app()->getLocale(), false) !!}
                        </div>
                        
                        @if($internship->contact_email || $internship->contact_phone)
                            <div style="margin-top: 15px; padding: 15px; background-color: #f8f9fa; border-radius: 5px;">
                                <h3 style="color: #2c3e50; font-size: 1.1em; margin-bottom: 10px;">Contact Information</h3>
                                
                                @if($internship->contact_email)
                                    <p style="margin-bottom: 5px; color: #444;">
                                        <strong>Email:</strong> <a href="mailto:{{ $internship->contact_email }}" style="color: #3498db; text-decoration: none;">{{ $internship->contact_email }}</a>
                                    </p>
                                @endif
                                
                                @if($internship->contact_phone)
                                    <p style="margin-bottom: 5px; color: #444;">
                                        <strong>Phone:</strong> <a href="tel:{{ $internship->contact_phone }}" style="color: #3498db; text-decoration: none;">{{ $internship->contact_phone }}</a>
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif --}}
            </div>
            
            <div class="application-sidebar" style="flex: 1; min-width: 250px;">
                @if($internship->image)
                    <div class="internship-image" style="margin-bottom: 20px;">
                        <img src="{{ asset('storage/' . $internship->image) }}" alt="{{ $internship->getTranslation('title', app()->getLocale(), false) }}" 
                             style="width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                @endif
                
                <!-- Application card -->
                <div class="application-card" style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px;">
                    <h3 style="color: #2c3e50; font-size: 1.3em; margin-bottom: 15px;">Internship Details</h3>
                    
                    <div class="internship-details" style="margin-bottom: 15px;">
                        <p style="margin-bottom: 8px; color: #444;">
                            <strong style="color: #2c3e50;">Location:</strong> {{ $internship->location }}
                        </p>
                        
                        <p style="margin-bottom: 8px; color: #444;">
                            <strong style="color: #2c3e50;">Duration:</strong> {{ $internship->duration ?? 'To be discussed' }}
                        </p>
                        
                        <p style="margin-bottom: 8px; color: #444;">
                            <strong style="color: #2c3e50;">Start Date:</strong> 
                            @if($internship->start_date)
                                @if(is_string($internship->start_date))
                                    {{ $internship->start_date }}
                                @else
                                    {{ $internship->start_date->format('F j, Y') }}
                                @endif
                            @else
                                Flexible / To be discussed
                            @endif
                        </p>
                        
                        <p style="margin-bottom: 8px; color: #444;">
                            <strong style="color: #2c3e50;">Compensation:</strong> {{ $internship->compensation ?? 'To be discussed' }}
                        </p>
                        
                        <p style="margin-bottom: 8px; color: #444;">
                            <strong style="color: #2c3e50;">Position:</strong> {{ $internship->position_type ?? 'Not specified' }}
                        </p>
                        
                        <p style="margin-bottom: 8px; color: #444;">
                            <strong style="color: #2c3e50;">Remote option:</strong> {{ $internship->remote_option ?? 'Not specified' }}
                        </p>
                        
                        @if($internship->application_deadline)
                            <p style="margin-bottom: 8px; color: {{ $internship->isExpired() ? '#e74c3c' : '#2c3e50' }};">
                                <strong>Deadline:</strong> 
                                @if(is_string($internship->application_deadline))
                                    {{ $internship->application_deadline }}
                                @else
                                    {{ $internship->application_deadline->format('F j, Y') }}
                                @endif
                                @if($internship->isExpired())
                                    <span style="color: #e74c3c; font-weight: bold;"> (Closed)</span>
                                @endif
                            </p>
                        @endif
                    </div>
                    
                    <a href="{{ route('internships.apply', $internship->id) }}" 
                       style="display: block; text-align: center; background-color: {{ $internship->isExpired() ? '#95a5a6' : '#3498db' }}; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; margin-top: 20px;"
                       {{ $internship->isExpired() ? 'disabled' : '' }}>
                        {{ $internship->isExpired() ? 'Application Closed' : 'Apply Now' }}
                    </a>
                </div>
                
                <!-- Contact info in sidebar (if not already displayed in application process) -->
                @if(($internship->contact_email || $internship->contact_phone) && !$internship->application_process)
                    <div class="contact-card" style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <h3 style="color: #2c3e50; font-size: 1.3em; margin-bottom: 15px;">Contact Information</h3>
                        
                        @if($internship->contact_email)
                            <p style="margin-bottom: 8px; color: #444;">
                                <strong style="color: #2c3e50;">Email:</strong> 
                                <a href="mailto:{{ $internship->contact_email }}" style="color: #3498db; text-decoration: none;">{{ $internship->contact_email }}</a>
                            </p>
                        @endif
                        
                        @if($internship->contact_phone)
                            <p style="margin-bottom: 8px; color: #444;">
                                <strong style="color: #2c3e50;">Phone:</strong>
                                <a href="tel:{{ $internship->contact_phone }}" style="color: #3498db; text-decoration: none;">{{ $internship->contact_phone }}</a>
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Related internships -->
        <div class="related-internships" style="margin-top: 50px;">
            <h2 style="color: #2c3e50; font-size: 1.6em; padding-bottom: 10px; border-bottom: 2px solid #ecf0f1; margin-bottom: 20px;">
                Similar Internships
            </h2>
            
            @php
                $relatedInternships = $internship->relatedInternships(3);
            @endphp
            
            @if($relatedInternships->count() > 0)
                <div class="related-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    @foreach($relatedInternships as $related)
                        <a href="{{ route('internships.show', $related->slug) }}" style="text-decoration: none; color: inherit;">
                            <div class="related-card" style="border: 1px solid #ecf0f1; border-radius: 8px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; height: 100%;">
                                @if($related->image)
                                    <div style="height: 160px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->getTranslation('title', app()->getLocale(), false) }}" 
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                                <div style="padding: 15px;">
                                    <div style="color: #3498db; font-size: 0.9em; font-weight: 600; margin-bottom: 5px;">{{ $related->location }}</div>
                                    <h3 style="margin-top: 0; font-size: 1.1em; margin-bottom: 8px; color: #2c3e50;">{{ $related->getTranslation('title', app()->getLocale(), false) }}</h3>
                                    <div style="color: #7f8c8d; font-size: 0.9em;">{{ $related->company_name }}</div>
                                    
                                    <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #ecf0f1; display: flex; justify-content: space-between; align-items: center;">
                                        <span style="font-size: 0.85em; color: #7f8c8d;">{{ $related->duration ?? 'Flexible duration' }}</span>
                                        <span style="background-color: #f1c40f; color: #fff; padding: 3px 8px; border-radius: 3px; font-size: 0.75em; font-weight: 600;">View Details</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p style="color: #7f8c8d; text-align: center; padding: 30px; background-color: #f8f9fa; border-radius: 8px;">
                    No similar internships found at the moment.
                    <br><br>
                    <a href="{{ route('internships.index') }}" style="color: #3498db; text-decoration: none; font-weight: 500;">
                        Browse all available internships
                    </a>
                </p>
            @endif
        </div>
    </div>
@endsection
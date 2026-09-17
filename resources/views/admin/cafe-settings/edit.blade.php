<x-admin.admin-layout title="Cafe Information">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 cafe-settings-page">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="aboutus-heading">
                <h3>Cafe Information</h3>
                <p>
                    Manage the contact details and opening information
                    displayed on the menu.
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form
                    action="{{ route('admin.cafe-settings.update') }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label for="cafe_name" class="form-label">
                                Cafe Name
                            </label>

                            <input
                                type="text"
                                id="cafe_name"
                                name="cafe_name"
                                class="form-control"
                                value="{{ old('cafe_name', $setting->cafe_name) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="tagline" class="form-label">
                                Tagline
                            </label>

                            <input
                                type="text"
                                id="tagline"
                                name="tagline"
                                class="form-control"
                                value="{{ old('tagline', $setting->tagline) }}"
                                placeholder="coffee • bites • moments"
                            >
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">
                                Address
                            </label>

                            <input
                                type="text"
                                id="address"
                                name="address"
                                class="form-control"
                                value="{{ old('address', $setting->address) }}"
                                placeholder="Dbayeh, Lebanon"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $setting->phone) }}"
                                placeholder="+961 71 234 567"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="whatsapp" class="form-label">
                                WhatsApp Number
                            </label>

                            <input
                                type="text"
                                id="whatsapp"
                                name="whatsapp"
                                class="form-control"
                                value="{{ old('whatsapp', $setting->whatsapp) }}"
                                placeholder="96171234567"
                            >

                            <small class="text-muted">
                                Include the country code without spaces.
                            </small>
                        </div>

                        <div class="col-md-6">
                            <label for="instagram" class="form-label">
                                Instagram
                            </label>

                            <input
                                type="text"
                                id="instagram"
                                name="instagram"
                                class="form-control"
                                value="{{ old('instagram', $setting->instagram) }}"
                                placeholder="@luma"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="opening_hours" class="form-label">
                                Opening Hours
                            </label>

                            <input
                                type="text"
                                id="opening_hours"
                                name="opening_hours"
                                class="form-control"
                                value="{{ old('opening_hours', $setting->opening_hours) }}"
                                placeholder="Daily, 8:00 AM – 11:00 PM"
                            >
                        </div>

                        <div class="col-12">
                            <label for="maps_url" class="form-label">
                                Google Maps Link
                            </label>

                            <input
                                type="url"
                                id="maps_url"
                                name="maps_url"
                                class="form-control"
                                value="{{ old('maps_url', $setting->maps_url) }}"
                                placeholder="https://maps.google.com/..."
                            >
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                Save Information
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </main>

</x-admin.admin-layout>
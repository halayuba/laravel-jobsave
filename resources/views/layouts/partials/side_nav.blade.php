<aside class="menu">
  <p class="menu-label">general</p>
  <ul class="menu-list">
    <aside-menu klass="fa fa-info-circle {{ side_nav('dashboard') }}" text="Instructions" link="{{ url('dashboard') }}"></aside-menu>

    <div class="dropdown">
      <button class="button is-large dropbtn">Create Content &nbsp; &nbsp;
        <span class="icon">
          <i class="ion-chevron-down"></i>
        </span>
      </button>

      <div class="dropdown-content">
        <a href="{{ route('resumes.create') }}">Add Resume</a>
        <a href="{{ route('employers.create') }}">Add Employer</a>
        <a href="{{ route('jobs.create') }}">Add Job</a>
        <a href="{{ url('applications/job-openings') }}">Add Application details</a>
        <a href="{{ route('interviews.jobList') }}">Add Interview details</a>
        <a href="{{ route('offers.interviewList') }}">Add Offer details</a>
      </div>
    </div>

  </ul>

  <div class="mgt_2"></div>

  <p class="menu-label">main</p>
  <ul class="menu-list">
    <aside-menu klass="fa fa-file-text {{ side_nav('resumes') }}" text="Resumes" link="{{ url('resumes') }}"></aside-menu>
    <aside-menu klass="fa fa-building {{ side_nav('employers') }}" text="Employers" link="{{ url('employers') }}"></aside-menu>
    <aside-menu klass="fa fa-briefcase {{ side_nav('jobs') }}" text="Jobs" link="{{ url('jobs') }}"></aside-menu>
    <aside-menu klass="fa fa-clone {{ side_nav('applications') }}" text="Applications" link="{{ url('applications') }}"></aside-menu>
    <aside-menu klass="fa fa-users {{ side_nav('interviews') }}" text="Interviews" link="{{ url('interviews') }}"></aside-menu>
    <aside-menu klass="fa fa-handshake-o {{ side_nav('offers') }}" text="Offers" link="{{ url('offers') }}"></aside-menu>
  </ul>
</aside>

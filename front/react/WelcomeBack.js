class WelcomeBack extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            apppVersion: '3',
            phone: '3'
        }
    }

    render(){
        return(
                
                <div class="container">
                    <a class="navbar-brand" href="frontend#header">
                        
                    </a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#bar"> 
                        <span><i class="fa fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="bar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link active" href="#header">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="frontend#hospital-management">Book Appointment</a></li>
                            <li class="nav-item"><a class="nav-link" href="frontend#service">Service</a></li>
                            <li class="nav-item"><a class="nav-link" href="frontend#package">Featured Doctor</a></li>
                            <li class="nav-item"><a class="nav-link" href="frontend#footer">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
                
                
                
                
                /*
            <>
                <h2>Hello {this.state.name || 'Friend'}! Welcome Back.</h2>
                {
                    this.state.apppVersion && this.state.apppVersion < 2
                    ? <p>Your app is out of date. Please download the new version and take a look at all the new features.</p> 
                    : ''
                }
                <CoolButton customText={this.state.apppVersion && this.state.apppVersion < 2 ? 'Download v2' : 'Download'} />
            </>
            */
        )
    }


}
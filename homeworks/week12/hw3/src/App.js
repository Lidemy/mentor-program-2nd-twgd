/*
    處理部落格 ( home & about )
*/

import React from 'react';
import Posts from './Posts';


const About = () => {
    return (
        <div>
            <div className="my-3">
                <h2>關於我</h2>
            </div>
        </div>
    )
}

const Home = () => {
    return (
        <div>
            <div className="my-3">
                <h2>首頁</h2>
            </div>
        </div>
    )
}

class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            tab: 'home'
        }
    }

    handleTabChange(e) {
        // 防止超連結
        e.preventDefault();

        const newTab = e.target.name;
        
        this.setState({
            tab: newTab,
        })
        
    }

    render() {
        const {tab} = this.state;

        return (
            <div>
                <nav className="navbar navbar-dark bg-dark">
                    <div className="container">
                        <ul className="navbar-nav d-flex flex-row">
                            <li className="nav-item mr-3">
                                <button
                                    className={"btn btn-outline-info " + (tab === 'home' ? 'active' : '')}
                                    name="home"
                                    onClick={(e) => this.handleTabChange(e)}
                                >Home</button>
                            </li>
                            <li className="nav-item mr-3">
                                <button
                                    className={"btn btn-outline-info " + (tab === 'about' ? 'active' : '')}
                                    name="about"
                                    onClick={(e) => this.handleTabChange(e)}
                                >About</button>
                            </li>
                            <li className="nav-item mr-3">
                                <button
                                    className={"btn btn-outline-info " + (tab === 'posts' ? 'active' : '')}
                                    name="posts"
                                    onClick={(e) => this.handleTabChange(e)}
                                >Posts</button>
                            </li>
                        </ul>  
                    </div>
                </nav>

                <div className="container">
                    {tab === 'home' && <Home />}
                    {tab === 'about' && <About />}
                    {tab === 'posts' && <Posts />}
                </div>
            </div>
        )
    }
}

export default App;
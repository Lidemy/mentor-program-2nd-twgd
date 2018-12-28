/*
    處理整個部落格
*/

import React from 'react';
import { HashRouter as Router, Route } from 'react-router-dom';
import Home from './Home';
import About from './About';
import Navbar from './Navbar';
import Header from './Header';
import PostList from './PostList';
import Post from './Post';
import NewPost from './NewPost';


class App extends React.Component {

    render() {
        
        return (
            <Router>
                <div>
                    <Header />
                    <Navbar />
                    <div className="container mt-5">
                        <div className="content">
                            <Route exact path="/" component={Home} />
                            <Route path="/about" component={About} />
                            <Route exact path="/posts" component={PostList} />
                            <Route path="/posts/:postId" component={Post} />
                            <Route path="/newpost" component={NewPost} />
                        </div>
                    </div>
                </div>
            </Router>
            
        )
    }
}

export default App;

import React from 'react';


const Header = () => {
    return (
        <div>
            <header className="header">
                <div className="branding">
                    <div className="branding__site-logo">
                        <img alt="site-logo" className="site-logo-image" width="80" height="80" src="http://stokpic.com/wp-content/uploads/2015/01/Wonans-Hands-With-Jewelry-Typing-On-Laptop-Sitting-On-A-Bed.jpg" />
                    </div>
                    <h2 className="branding__site-title">My Blog</h2>
                    <p className="branding__site-description">哈囉哈囉嗨嗨嗨這裡是我的部落格我在這裡發廢文啦啦啦耶耶耶</p>
                </div>
            </header>
        </div>
        
    );
}

export default Header;
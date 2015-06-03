using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.Drawing.Imaging;
using IAGenetic_DrawingMuse.Genetic;

namespace IAGenetic_DrawingMuse
{
    public partial class Form1 : Form
    {
        private PopulationGenetic populationGenetic;
        private Bitmap imgGoal;
        private PopulationGoal populationGoal;

        public Form1()
        {
            InitializeComponent();

            // imgGoal = new Bitmap(Properties.Resources.france);
            imgGoal = new Bitmap(Properties.Resources.mario_pixelise);
            // imgGoal = new Bitmap(Properties.Resources.landscape);
            // imgGoal = new Bitmap(Properties.Resources.joconde);
            
            pictureBoxGoal.Image = imgGoal;
        }

        private void Draw()
        {
            Bitmap imgGenetic = new Bitmap(populationGenetic.GetWitdh(), populationGenetic.GetHeight());
            IndividualColor[] individuals = populationGenetic.GetIndividuals();
            int iPixel = 0;
            int iLine, iColumn;
            foreach (IndividualColor pixel in individuals)
            {
                iLine = (int)Math.Floor((double)(iPixel / populationGenetic.GetWitdh()));
                iColumn = iPixel - iLine * populationGenetic.GetWitdh();
                imgGenetic.SetPixel(iColumn, iLine, pixel.GetColor());

                iPixel++;
            }

            pictureBoxGenetic.Image = imgGenetic;
        }

        private void buttonInitialization_Click(object sender, EventArgs e)
        {
            populationGoal = new PopulationGoal(imgGoal);
            populationGenetic = new PopulationGenetic(populationGoal);
            Draw();
        }

        private void buttonEvolve_Click(object sender, EventArgs e)
        {
            populationGenetic.Evolve(populationGoal);
            Draw();
        }
    }
}

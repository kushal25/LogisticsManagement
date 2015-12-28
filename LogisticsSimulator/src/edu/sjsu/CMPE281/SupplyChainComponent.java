package edu.sjsu.CMPE281;

import edu.sjsu.CMPE281.Nodes.ControlNode;
import edu.sjsu.CMPE281.Nodes.Sensor;
import edu.sjsu.CMPE281.ServerComponent.Receiver;
import edu.sjsu.CMPE281.ServerComponent.Transmitter;

public class SupplyChainComponent implements Runnable
{
	private static SupplyChainComponent me = null;
	private Thread scThread = null;
	private ControlNode[] controlNodes = null;
	private int noOfControlNodes = Constants.NO_OF_CONTROL_NODES;

	private Transmitter transmitter = null;
	private Receiver receiver = null;
	
	private long currTimeMillis = 0;
	private long prevTimeMillis = 0;
	

	public SupplyChainComponent()
	{
		me = this;
		scThread = new Thread(this, "Supply Chain Inventory Management");
	}

	public void init()
	{
		scThread.start();
	}

	public static SupplyChainComponent getComponent()
	{
		return me;
	}
	
	public ControlNode[] getControlNodes()
	{
		return controlNodes;
	}

	public Sensor getSensorId(String sensorId)
	{
		Sensor sensor = null;
		for (int cIndex = 0; cIndex < noOfControlNodes; cIndex++)
		{
			if ((sensor = controlNodes[cIndex].getSensorById(sensorId)) != null)
			{
				break;
			}
		}
		return sensor;
	}

	@Override
	public void run()
	{
		// initialize timer
		currTimeMillis = System.currentTimeMillis();
		
		// initial Server Components
		transmitter = new Transmitter();
		receiver = new Receiver();
		
		// initialize control nodes
		controlNodes = new ControlNode[noOfControlNodes];
		for (int cIndex = 0; cIndex < noOfControlNodes; cIndex++)
		{
			controlNodes[cIndex] = new ControlNode();
			controlNodes[cIndex].init(cIndex);
		}
		// initializing server components
		transmitter.init();
		receiver.init();
		
		while (true)
		{
			prevTimeMillis = currTimeMillis;
			currTimeMillis = System.currentTimeMillis();
			long delta = currTimeMillis - prevTimeMillis;
			
			for (int cIndex = 0; cIndex < noOfControlNodes; cIndex++)
			{
				controlNodes[cIndex].update(delta);
			}

			transmitter.update(delta);
			receiver.update(delta);
		}
	}
}